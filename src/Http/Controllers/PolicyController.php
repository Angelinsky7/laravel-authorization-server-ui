<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\Policy\StorePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreGroupPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreRolePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreScopePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreUserPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateGroupPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateRolePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateScopePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateUserPolicyRequest;
use Darkink\AuthorizationServer\Models\Policy;
use Darkink\AuthorizationServer\Models\GroupPolicy;
use Darkink\AuthorizationServer\Models\RolePolicy;
use Darkink\AuthorizationServer\Models\UserPolicy;
use Darkink\AuthorizationServer\Repositories\PolicyRepository;
use Darkink\AuthorizationServer\Repositories\GroupPolicyRepository;
use Darkink\AuthorizationServer\Repositories\GroupRepository;
use Darkink\AuthorizationServer\Repositories\RolePolicyRepository;
use Darkink\AuthorizationServer\Repositories\UserPolicyRepository;
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
    protected UserPolicyRepository $userPolicyRepository;

    public function __construct(
        PolicyRepository $policyRepository,
        GroupPolicyRepository $groupPolicyRepository,
        RolePolicyRepository $rolePolicyRepository,
        UserPolicyRepository $userPolicyRepository
    ) {
        $this->policyRepository = $policyRepository;
        $this->groupPolicyRepository = $groupPolicyRepository;
        $this->rolePolicyRepository = $rolePolicyRepository;
        $this->userPolicyRepository = $userPolicyRepository;
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
            case "user":
                return view('policy-ui::Policy.User.create');
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
            case "user":
                return $this->storeUser(StoreUserPolicyRequest::createFrom($request));
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

    public function storeUser(StoreUserPolicyRequest $request)
    {
        $validated = $request->validate($request->rules());

        $this->userPolicyRepository->create(
            $validated['name'],
            $validated['description'],
            $validated['logic'],
            $validated['permissions'] ?? [],
            $validated['users'],
        );

        $request->session()->flash('success_message', 'User Policy created.');
        return redirect()->route('policy-ui.policy.index');
    }


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
            case UserPolicy::class:
                return view('policy-ui::Policy.User.update', [
                    'item' => $policy->policy
                ]);
                break;
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
            case "user":
                return $this->updateUser(UpdateUserPolicyRequest::createFrom($request), $policy->policy);
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

    public function updateUser(UpdateUserPolicyRequest $request, UserPolicy $policy)
    {
        $validated = $request->validate($request->rules());

        $this->userPolicyRepository->update(
            $policy,
            $validated['name'],
            $validated['description'],
            $validated['logic'],
            $validated['permissions'] ?? [],
            $validated['users'],
        );

        $request->session()->flash('success_message', 'User Policy updated.');
        return redirect()->route('policy-ui.policy.index');
    }

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
