<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\Policy\StorePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreGroupPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreScopePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateGroupPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateScopePolicyRequest;
use Darkink\AuthorizationServer\Models\Policy;
use Darkink\AuthorizationServer\Models\GroupPolicy;
use Darkink\AuthorizationServer\Repositories\PolicyRepository;
use Darkink\AuthorizationServer\Repositories\GroupPolicyRepository;
use Darkink\AuthorizationServer\Repositories\GroupRepository;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;
use Exception;
use Illuminate\Http\Request;

class PolicyController
{

    use HasSorting, HasSearch;

    protected PolicyRepository $policyRepository;
    protected GroupPolicyRepository $groupPolicyRepository;
    protected GroupRepository $groupRepository;

    public function __construct(
        PolicyRepository $policyRepository,
        GroupPolicyRepository $groupPolicyRepository,
        GroupRepository $groupRepository
    ) {
        $this->policyRepository = $policyRepository;
        $this->groupPolicyRepository = $groupPolicyRepository;
        $this->groupRepository = $groupRepository;
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

    public function create(Request $request)
    {
        $type = $request->query('type');
        // $all_policies = $this->policyRepository->gets()->all()->map(fn ($p) => ['value' => $p->id, 'item' => ['caption' => $p->name], 'order' => $p->name]);

        switch ($type) {
            case "group":
                $all_groups = $this->groupRepository->gets()->all()->map(fn ($p) => ['value' => 'g' . $p->id, 'item' => ['caption' => $p->display_name, 'type' => 'group'], 'order' => $p->name]);
                return view('policy-ui::Policy.Group.create', [
                    'all_groups' => $all_groups,
                    // 'all_policies' => $all_policies
                ]);
                // case "resource":
                //     return view('policy-ui::Policy.Resource.create');
        }
        return view('policy-ui::Policy.create');
    }

    public function store(Request $request)
    {
        switch ($request->query('type')) {
            case "group":
                return $this->storeGroup(StoreGroupPolicyRequest::createFrom($request));
                // case "resource":
                //     return $this->storeResource(StoreResourcePermissionRequest::createFrom($request));
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
            $validated['groups'],
        );

        $request->session()->flash('success_message', 'Scope Permission created.');
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

    public function edit(Policy $policy)
    {
        // $all_policies = $this->policyRepository->gets()->all()->map(fn ($p) => ['value' => $p->id, 'item' => ['caption' => $p->name], 'order' => $p->name]);

        switch (get_class($policy->policy)) {
            case GroupPolicy::class:
                $all_groups = $this->groupRepository->gets()->all()->map(fn ($p) => ['value' => 'g' . $p->id, 'item' => ['caption' => $p->display_name, 'type' => 'group'], 'order' => $p->name]);
                return view('policy-ui::Policy.Group.update', [
                    'item' => $policy->policy,
                    'all_groups' => $all_groups,
                    // 'all_policies' => $all_policies
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
                return $this->updatePolicy(UpdateGroupPolicyRequest::createFrom($request), $policy->policy);
                // case "resource":
                //     return $this->updateResource(UpdateResourcePermissionRequest::createFrom($request), $policy->permission);
        }
        throw new Exception('Invaid type given');
    }

    public function updatePolicy(UpdateGroupPolicyRequest $request, GroupPolicy $policy)
    {
        $validated = $request->validate($request->rules());

        $this->groupPolicyRepository->update(
            $policy,
            $validated['name'],
            $validated['description'],
            $validated['logic'],
            $validated['groups'],
        );

        $request->session()->flash('success_message', 'Group Policy updated.');
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
