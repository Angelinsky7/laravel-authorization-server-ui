<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Carbon\Carbon;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreAggregatedPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreClientPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreGroupPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreRolePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreTimePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\StoreUserPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateAggregatedPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateClientPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateGroupPolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateRolePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateTimePolicyRequest;
use Darkink\AuthorizationServer\Http\Requests\Policy\UpdateUserPolicyRequest;
use Darkink\AuthorizationServer\Models\AggregatedPolicy;
use Darkink\AuthorizationServer\Models\ClientPolicy;
use Darkink\AuthorizationServer\Models\Policy;
use Darkink\AuthorizationServer\Models\GroupPolicy;
use Darkink\AuthorizationServer\Models\RolePolicy;
use Darkink\AuthorizationServer\Models\TimePolicy;
use Darkink\AuthorizationServer\Models\TimeRange;
use Darkink\AuthorizationServer\Models\UserPolicy;
use Darkink\AuthorizationServer\Repositories\AggregatedPolicyRepository;
use Darkink\AuthorizationServer\Repositories\ClientPolicyRepository;
use Darkink\AuthorizationServer\Repositories\PolicyRepository;
use Darkink\AuthorizationServer\Repositories\GroupPolicyRepository;
use Darkink\AuthorizationServer\Repositories\RolePolicyRepository;
use Darkink\AuthorizationServer\Repositories\TimePolicyRepository;
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
    protected ClientPolicyRepository $clientPolicyRepository;
    protected TimePolicyRepository $timePolicyRepository;
    protected AggregatedPolicyRepository $aggregatedPolicyRepository;

    public function __construct(
        PolicyRepository $policyRepository,
        GroupPolicyRepository $groupPolicyRepository,
        RolePolicyRepository $rolePolicyRepository,
        UserPolicyRepository $userPolicyRepository,
        ClientPolicyRepository $clientPolicyRepository,
        TimePolicyRepository $timePolicyRepository,
        AggregatedPolicyRepository $aggregatedPolicyRepository
    ) {
        $this->policyRepository = $policyRepository;
        $this->groupPolicyRepository = $groupPolicyRepository;
        $this->rolePolicyRepository = $rolePolicyRepository;
        $this->userPolicyRepository = $userPolicyRepository;
        $this->clientPolicyRepository = $clientPolicyRepository;
        $this->timePolicyRepository = $timePolicyRepository;
        $this->aggregatedPolicyRepository = $aggregatedPolicyRepository;
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
            case "client":
                return view('policy-ui::Policy.Client.create');
            case "time":
                return view('policy-ui::Policy.Time.create');
            case "aggregated":
                return view('policy-ui::Policy.Aggregated.create');
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
            case "client":
                return $this->storeClient(StoreClientPolicyRequest::createFrom($request));
            case "time":
                return $this->storeTime(StoreTimePolicyRequest::createFrom($request));
            case "aggregated":
                return $this->storeAggregated(StoreAggregatedPolicyRequest::createFrom($request));
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

    public function storeClient(StoreClientPolicyRequest $request)
    {
        $validated = $request->validate($request->rules());

        $this->clientPolicyRepository->create(
            $validated['name'],
            $validated['description'],
            $validated['logic'],
            $validated['permissions'] ?? [],
            $validated['clients'],
        );

        $request->session()->flash('success_message', 'Client Policy created.');
        return redirect()->route('policy-ui.policy.index');
    }

    public function storeTime(StoreTimePolicyRequest $request)
    {
        $validated = $request->validate($request->rules());



        $this->timePolicyRepository->create(
            $validated['name'],
            $validated['description'],
            $validated['logic'],
            $validated['permissions'] ?? [],
            $validated['not_before'] != null ? Carbon::parse($validated['not_before']) : null,
            $validated['not_after'] != null ? Carbon::parse($validated['not_after']) : null,
            (new TimeRange())->forceFill($validated['day_of_month']),
            (new TimeRange())->forceFill($validated['month']),
            (new TimeRange())->forceFill($validated['year']),
            (new TimeRange())->forceFill($validated['hour']),
            (new TimeRange())->forceFill($validated['minute'])
        );

        $request->session()->flash('success_message', 'Time Policy created.');
        return redirect()->route('policy-ui.policy.index');
    }

    public function storeAggregated(StoreAggregatedPolicyRequest $request)
    {
        $validated = $request->validate($request->rules());

        $this->aggregatedPolicyRepository->create(
            $validated['name'],
            $validated['description'],
            $validated['logic'],
            $validated['permissions'] ?? [],
            $validated['decision_strategy'],
            $validated['policies'],
        );

        $request->session()->flash('success_message', 'Aggregate Policy created.');
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
            case ClientPolicy::class:
                return view('policy-ui::Policy.Client.update', [
                    'item' => $policy->policy
                ]);
                break;
            case TimePolicy::class:
                return view('policy-ui::Policy.Time.update', [
                    'item' => $policy->policy
                ]);
                break;
            case AggregatedPolicy::class:
                return view('policy-ui::Policy.Aggregated.update', [
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
            case "client":
                return $this->updateClient(UpdateClientPolicyRequest::createFrom($request), $policy->policy);
            case "time":
                return $this->updateTime(UpdateTimePolicyRequest::createFrom($request), $policy->policy);
            case "aggregated":
                return $this->updateAggregated(UpdateAggregatedPolicyRequest::createFrom($request), $policy->policy);
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

    public function updateClient(UpdateClientPolicyRequest $request, ClientPolicy $policy)
    {
        $validated = $request->validate($request->rules());

        $this->clientPolicyRepository->update(
            $policy,
            $validated['name'],
            $validated['description'],
            $validated['logic'],
            $validated['permissions'] ?? [],
            $validated['clients'],
        );

        $request->session()->flash('success_message', 'Client Policy updated.');
        return redirect()->route('policy-ui.policy.index');
    }

    public function updateTime(UpdateTimePolicyRequest $request, TimePolicy $policy)
    {
        $validated = $request->validate($request->rules());

        $this->timePolicyRepository->update(
            $policy,
            $validated['name'],
            $validated['description'],
            $validated['logic'],
            $validated['permissions'] ?? [],
            $validated['not_before'] != null ? Carbon::parse($validated['not_before']) : null,
            $validated['not_after'] != null ? Carbon::parse($validated['not_after']) : null,
            (new TimeRange())->forceFill($validated['day_of_month']),
            (new TimeRange())->forceFill($validated['month']),
            (new TimeRange())->forceFill($validated['year']),
            (new TimeRange())->forceFill($validated['hour']),
            (new TimeRange())->forceFill($validated['minute'])
        );

        $request->session()->flash('success_message', 'Time Policy updated.');
        return redirect()->route('policy-ui.policy.index');
    }

    public function updateAggregated(UpdateAggregatedPolicyRequest $request, AggregatedPolicy $policy)
    {
        $validated = $request->validate($request->rules());

        $this->aggregatedPolicyRepository->update(
            $policy,
            $validated['name'],
            $validated['description'],
            $validated['logic'],
            $validated['permissions'] ?? [],
            $validated['decision_strategy'],
            $validated['policies'],
        );

        $request->session()->flash('success_message', 'Aggregate Policy updated.');
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

        switch (get_class($policy->policy)) {
            case GroupPolicy::class:
                $this->groupPolicyRepository->delete($policy->policy);
                break;
            case RolePolicy::class:
                $this->rolePolicyRepository->delete($policy->policy);
                break;
            case UserPolicy::class:
                $this->userPolicyRepository->delete($policy->policy);
                break;
            case ClientPolicy::class:
                $this->clientPolicyRepository->delete($policy->policy);
                break;
            case TimePolicy::class:
                $this->timePolicyRepository->delete($policy->policy);
                break;
            case AggregatedPolicy::class:
                $this->aggregatedPolicyRepository->delete($policy->policy);
            default:
                $this->policyRepository->delete($policy);
                break;
        }

        request()->session()->flash('success_message', 'Permission deleted.');
        return redirect()->route('policy-ui.policy.index');
    }
}
