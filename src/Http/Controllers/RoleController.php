<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\Role\StoreRoleRequest;
use Darkink\AuthorizationServer\Http\Requests\Role\UpdateRoleRequest;
use Darkink\AuthorizationServer\Models\DecisionStrategy;
use Darkink\AuthorizationServer\Models\Permission;
use Darkink\AuthorizationServer\Models\PolicyLogic;
use Darkink\AuthorizationServer\Models\Resource;
use Darkink\AuthorizationServer\Models\Role;
use Darkink\AuthorizationServer\Models\RolePolicy;
use Darkink\AuthorizationServer\Models\Scope;
use Darkink\AuthorizationServer\Models\ScopePermission;
use Darkink\AuthorizationServer\Repositories\ResourceRepository;
use Darkink\AuthorizationServer\Repositories\RolePolicyRepository;
use Darkink\AuthorizationServer\Repositories\RoleRepository;
use Darkink\AuthorizationServer\Repositories\ScopePermissionRepository;
use Darkink\AuthorizationServerUI\Http\Requests\Role\PermissionRoleRequest;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;

class RoleController
{
    use HasSorting, HasSearch;

    protected RoleRepository $repo;
    protected ResourceRepository $resourceRepository;
    protected ScopePermissionRepository $permissionRepository;
    protected RolePolicyRepository $policyRepository;

    public function __construct(
        RoleRepository $repo,
        ResourceRepository $resourceRepository,
        ScopePermissionRepository $permissionRepository,
        RolePolicyRepository $policyRepository
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

        return view('policy-ui::Role.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('policy-ui::Role.create');
    }

    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();

        $this->repo->create(
            $validated['name'],
            $validated['display_name'],
            $validated['description'],
            $validated['parents'] ?? []
        );

        $request->session()->flash('success_message', 'Role created.');
        return redirect()->route('policy-ui.role.index');
    }

    public function edit(Role $role)
    {
        return view('policy-ui::Role.update', [
            'item' => $role
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validated = $request->validated();
        $this->repo->update(
            $role,
            $validated['name'],
            $validated['display_name'],
            $validated['description'],
            $validated['parents'] ?? []
        );

        $request->session()->flash('success_message', 'Role updated.');
        return redirect()->route('policy-ui.role.index');
    }

    public function delete(Role $role)
    {
        return view('policy-ui::Role.delete', [
            'item' => $role
        ]);
    }

    public function destroy(Role $role)
    {
        $this->repo->delete($role);

        request()->session()->flash('success_message', 'Role deleted.');
        return redirect()->route('policy-ui.role.index');
    }


    public function rights(Role $role)
    {
        //TODO(demarco): It could be good to have the same pattern for all the rrepo.
        $all_resources = $this->resourceRepository->gets()->all();

        return view('policy-ui::Role.rights', [
            'role' => $role,
            'resources' => $all_resources,
            'permissions' => $this->getActivePermissionsList($role)
        ]);
    }

    public function updateRights(Role $role, PermissionRoleRequest $request)
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

        $policy_name = $this->getRolePolicyName($role);
        /** @var RolePolicy $policy */
        $policy = $this->policyRepository->gets()->whereRelation('parent', 'name', '=', $policy_name)->first();
        if ($policy == null) {
            $this->policyRepository->create($policy_name, "Default system policy for {$role->display_name}", PolicyLogic::Positive, true, $permission_ids, [$role]);
        } else {
            $this->policyRepository->update($policy, $policy->parent->name, $policy->parent->description, $policy->parent->logic, true, $permission_ids, $policy->roles);
        }

        //TODO(demarco): It could be good to have the same pattern for all the rrepo.
        $all_resources = $this->resourceRepository->gets()->all();

        return view('policy-ui::Role.rights', [
            'role' => $role,
            'resources' => $all_resources,
            'permissions' => $this->getActivePermissionsList($role)
        ]);
    }

    private function getRolePolicyName(Role $role): string
    {
        return "System.Policy.Role.{$role->name}";
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

    private function getActivePermissionsList(Role $role): array
    {
        /** @var RolePolicy $policy */
        $policy = $this->policyRepository->gets()->whereRelation('parent', 'name', '=', $this->getRolePolicyName($role))->first();
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
