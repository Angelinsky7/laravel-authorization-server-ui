<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\Group\StoreGroupRequest;
use Darkink\AuthorizationServer\Http\Requests\Group\UpdateGroupRequest;
use Darkink\AuthorizationServer\Models\DecisionStrategy;
use Darkink\AuthorizationServer\Models\Group;
use Darkink\AuthorizationServer\Models\Permission;
use Darkink\AuthorizationServer\Models\PolicyLogic;
use Darkink\AuthorizationServer\Models\Resource;
use Darkink\AuthorizationServer\Models\Scope;
use Darkink\AuthorizationServer\Policy;
use Darkink\AuthorizationServer\Repositories\GroupPolicyRepository;
use Darkink\AuthorizationServer\Repositories\GroupRepository;
use Darkink\AuthorizationServer\Repositories\ResourceRepository;
use Darkink\AuthorizationServer\Repositories\ScopePermissionRepository;
use Darkink\AuthorizationServerUI\Http\Requests\Group\PermissionGroupRequest;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;

class GroupController
{
    use HasSorting, HasSearch;

    protected GroupRepository $repo;
    protected ResourceRepository $resourceRepository;
    protected ScopePermissionRepository $permissionRepository;
    protected GroupPolicyRepository $policyRepository;

    public function __construct(
        GroupRepository $repo,
        ResourceRepository $resourceRepository,
        ScopePermissionRepository $permissionRepository,
        GroupPolicyRepository $policyRepository
    ) {
        $this->repo = $repo;
        $this->resourceRepository = $resourceRepository;
        $this->permissionRepository = $permissionRepository;
        $this->policyRepository = $policyRepository;
    }

    public function index()
    {
        $items = $this->repo->gets()->query();
        $items = $this->addSearchToQueryModel($items);
        $items = $this->addOrderByToQueryModel($items);
        $items = $items->paginate(25)->withQueryString();

        return view('policy-ui::Group.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('policy-ui::Group.create');
    }

    public function store(StoreGroupRequest $request)
    {
        $validated = $request->validated();

        $this->repo->create(
            $validated['name'],
            $validated['display_name'],
            $validated['description'],
            $validated['memberofs'] ?? [],
            $validated['members'] ?? []
        );

        $request->session()->flash('success_message', 'Group created.');
        return redirect()->route('policy-ui.group.index');
    }

    public function edit(Group $group)
    {
        return view('policy-ui::Group.update', [
            'item' => $group,
        ]);
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $validated = $request->validated();
        $this->repo->update(
            $group,
            $validated['name'],
            $validated['display_name'],
            $validated['description'],
            $validated['memberofs'] ?? [],
            $validated['members'] ?? []
        );

        $request->session()->flash('success_message', 'Group updated.');
        return redirect()->route('policy-ui.group.index');
    }

    public function delete(Group $group)
    {
        return view('policy-ui::Group.delete', [
            'item' => $group
        ]);
    }

    public function destroy(Group $group)
    {
        $this->repo->delete($group);

        request()->session()->flash('success_message', 'Group deleted.');
        return redirect()->route('policy-ui.group.index');
    }

    public function rights(Group $group)
    {
        //TODO(demarco): It could be good to have the same pattern for all the rrepo.
        $all_resources = $this->resourceRepository->gets()->all();

        return view('policy-ui::Group.rights', [
            'group' => $group,
            'resources' => $all_resources,
            'permissions' => $this->getActivePermissionsList($group)
        ]);
    }

    public function updateRights(Group $group, PermissionGroupRequest $request)
    {
        $validated = $request->validated();

        $all_permissions = $this->getPermissionsList();
        $permissions_to_add = array_filter($all_permissions, fn ($p) => array_key_exists($p, $validated['permissions']));

        $all_existing_permissions = $this->permissionRepository->gets();
        $permission_ids = [];

        foreach ($permissions_to_add as $item) {
            $permission_name = "{$this->getDefaultSystemPermissionNamespace()}$item";
            /** @var ScopePermission $permission */
            $permission = $all_existing_permissions->clone()->whereRelation('parent', 'name', '=', $permission_name)->first();
            if ($permission == null) {
                $item_splitted = explode('◬', $item);
                /** @var Resource $resource */
                $resource = $this->resourceRepository->gets()->all()->where('name', '=', $item_splitted[0])->firstOrFail();
                $scopes = array_values(array_map(fn (Scope $a) => $a->id, array_filter($resource->scopes()->get()->all(), fn ($p) => $p->name == $item_splitted[1])));
                $permission = $this->permissionRepository->create($permission_name, "Default system permission for {$item}", DecisionStrategy::Affirmative, true, [], $resource, $scopes);
                $permission_ids[] = $permission->id;
            } else {
                $permission_ids[] = $permission->id;
            }
        }

        $policy_name = $this->getGroupPolicyName($group);
        /** @var GroupPolicy $policy */
        $policy = $this->policyRepository->gets()->whereRelation('parent', 'name', '=', $policy_name)->first();
        if ($policy == null) {
            $this->policyRepository->create($policy_name, "Default system policy for {$group->display_name}", PolicyLogic::Positive, true, $permission_ids, [$group]);
        } else {
            $this->policyRepository->update($policy, $policy->parent->name, $policy->parent->description, $policy->parent->logic, true, $permission_ids, $policy->groups);
        }

        //TODO(demarco): It could be good to have the same pattern for all the rrepo.
        $all_resources = $this->resourceRepository->gets()->all();

        return view('policy-ui::Group.rights', [
            'group' => $group,
            'resources' => $all_resources,
            'permissions' => $this->getActivePermissionsList($group)
        ]);
    }

    private function getGroupPolicyName(Group $role): string
    {
        return "System.Policy.Group.{$role->name}";
    }

    private function getDefaultSystemPermissionNamespace()
    {
        return "System.Permission.";
    }

    private function getPermissionsList(): array
    {
        $all_resources = $this->resourceRepository->gets()->all();
        $resources_scopes_items = $all_resources->map(fn (Resource $p) => $p->scopes()->get()->map(fn (Scope $a) => "{$p->name}◬{$a->name}")->all())->all();
        $permissions = array_flatten($resources_scopes_items);
        return $permissions;
    }

    private function getActivePermissionsList(Group $group): array
    {
        /** @var GroupPolicy $policy */
        $policy = $this->policyRepository->gets()->whereRelation('parent', 'name', '=', $this->getGroupPolicyName($group))->first();
        if ($policy == null) {
            return [];
        }
        $permission_namespace = $this->getDefaultSystemPermissionNamespace();
        $permissions = $policy->parent->permissions->map(fn (Permission $p) => $p->name)->toArray();
        $permissions = array_filter($permissions, fn ($p) => strpos($p, $permission_namespace) === 0);
        $permissions = array_map(fn ($p) => substr($p, strlen($permission_namespace)), $permissions);
        return $permissions;
    }
}
