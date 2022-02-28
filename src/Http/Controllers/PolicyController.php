<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\Policy\StorePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreGroupPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreRolePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreScopePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateGroupPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateRolePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateScopePolicyRequest;
use Darkink\AuthorizationServer\Models\Policy;
use Darkink\AuthorizationServer\Models\GroupPolicy;
use Darkink\AuthorizationServer\Models\RolePolicy;
use Darkink\AuthorizationServer\Repositories\PolicyRepository;
use Darkink\AuthorizationServer\Repositories\GroupPolicyRepository;
use Darkink\AuthorizationServer\Repositories\GroupRepository;
use Darkink\AuthorizationServer\Repositories\RolePolicyRepository;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;
use Exception;
use Illuminate\Http\Request;

class PolicyController
{

    use HasSorting, HasSearch;

    protected PolicyRepository $policyRepository;
    protected GroupPolicyRepository $groupPolicyRepository;
    protected RolePolicyRepository $rolePolicyRepository;

    public function __construct(
        PolicyRepository $policyRepository,
        GroupPolicyRepository $groupPolicyRepository,
        RolePolicyRepository $rolePolicyRepository
    ) {
        $this->policyRepository = $policyRepository;
        $this->groupPolicyRepository = $groupPolicyRepository;
        $this->rolePolicyRepository = $rolePolicyRepository;
    }

    public function index()
    {
        $items = $this->policyRepository->gets();
        $items = $this->addSearchToQueryModel($items);
        $items = $this->addOrderByToQueryModel($items);
        $items = $items->paginate(25)->withQueryString();

        return view('policy-ui::Policy.index', [
            'items' => $items
        ]);
    }

    #region store

    public function create(Request $request)
    {
        $type = $request->query('type');

        switch ($type) {
            case "group":
                return view('policy-ui::Policy.Group.create');
            case "role":
                return view('policy-ui::Policy.Role.create');
        }
        return view('policy-ui::Policy.create');
    }

    public function store(Request $request)
    {
        switch ($request->query('type')) {
            case "group":
                return $this->storeGroup(StoreGroupPolicyRequest::createFrom($request));
            case "role":
                return $this->storeRole(StoreRolePolicyRequest::createFrom($request));
        }
        throw new Exception('Invaid type given');
    }

    public function storeGroup(StoreGroupPolicyRequest $request)
    {
        $validated = $request->validate($request->rules());

        $this->groupPolicyRepository->create(
            $validated['name'],
            $validated['description'],
            $validated['logic'],
            $validated['permissions'] ?? [],
            $validated['groups'],
        );

        $request->session()->flash('success_message', 'Group Policy created.');
        return redirect()->route('policy-ui.policy.index');
    }

    public function storeRole(StoreRolePolicyRequest $request)
    {
        $validated = $request->validate($request->rules());

        $this->rolePolicyRepository->create(
            $validated['name'],
            $validated['description'],
            $validated['logic'],
            $validated['permissions'] ?? [],
            $validated['roles'],
        );

        $request->session()->flash('success_message', 'Role Policy created.');
        return redirect()->route('policy-ui.policy.index');
    }

    // public function storeResource(StoreResourcePermissionRequest $request)
    // {
    //     $validated = $request->validate($request->rules());

    //     $this->groupPolicyRepository->create(
    //         $validated['name'],
    //         $validated['description'],
    //         $validated['decision_strategy'],
    //         $validated['resource_type'],
    //         $validated['resource'],
    //     );

    //     $request->session()->flash('success_message', 'Resource permission created.');
    //     return redirect()->route('policy-ui.policy.index');
    // }

    #endregion

    #region edit

    public function edit(Policy $policy)
    {
        switch (get_class($policy->policy)) {
            case GroupPolicy::class:
                return view('policy-ui::Policy.Group.update', [
                    'item' => $policy->policy
                ]);
                break;
            case RolePolicy::class:
                return view('policy-ui::Policy.Role.update', [
                    'item' => $policy->policy
                ]);
                break;
                // case ResourcePermission::class:
                //     return view('policy-ui::Policy.Resource.update', [
                //         'item' => $policy->permission
                //     ]);
                //     break;
        }
        return view('policy-ui::Policy.update', [
            'item' => $policy
        ]);
    }

    public function update(Request $request, Policy $policy)
    {
        switch ($request->query('type')) {
            case "group":
                return $this->updateGroup(UpdateGroupPolicyRequest::createFrom($request), $policy->policy);
            case "role":
                return $this->updateRole(UpdateRolePolicyRequest::createFrom($request), $policy->policy);
                // case "resource":
                //     return $this->updateResource(UpdateResourcePermissionRequest::createFrom($request), $policy->permission);
        }
        throw new Exception('Invaid type given');
    }

    public function updateGroup(UpdateGroupPolicyRequest $request, GroupPolicy $policy)
    {
        $validated = $request->validate($request->rules());

        $this->groupPolicyRepository->update(
            $policy,
            $validated['name'],
            $validated['description'],
            $validated['logic'],
            $validated['permissions'] ?? [],
            $validated['groups'],
        );

        $request->session()->flash('success_message', 'Group Policy updated.');
        return redirect()->route('policy-ui.policy.index');
    }

    public function updateRole(UpdateRolePolicyRequest $request, RolePolicy $policy)
    {
        $validated = $request->validate($request->rules());

        $this->rolePolicyRepository->update(
            $policy,
            $validated['name'],
            $validated['description'],
            $validated['logic'],
            $validated['permissions'] ?? [],
            $validated['roles'],
        );

        $request->session()->flash('success_message', 'Role Policy updated.');
        return redirect()->route('policy-ui.policy.index');
    }

    // public function updateResource(UpdateGroupPolicyRequest $request, GroupPolicy $policy)
    // {
    //     $validated = $request->validate($request->rules());

    //     $this->resourcepolicyRepository->update(
    //         $policy,
    //         $validated['name'],
    //         $validated['description'],
    //         $validated['decision_strategy'],
    //         $validated['resource_type'],
    //         $validated['resource'],
    //     );

    //     $request->session()->flash('success_message', 'Resource Permission updated.');
    //     return redirect()->route('policy-ui.policy.index');
    // }

    #endregion

    public function delete(Policy $policy)
    {
        return view('policy-ui::Policy.delete', [
            'item' => $policy
        ]);
    }

    public function destroy($id)
    {
        $policy = Policy::findOrFail($id);
        $this->policyRepository->delete($policy);

        request()->session()->flash('success_message', 'Permission deleted.');
        return redirect()->route('policy-ui.policy.index');
    }
}
