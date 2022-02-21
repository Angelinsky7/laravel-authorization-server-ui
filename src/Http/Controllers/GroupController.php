<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\Group\StoreGroupRequest;
use Darkink\AuthorizationServer\Http\Requests\Group\UpdateGroupRequest;
use Darkink\AuthorizationServer\Models\Group;
use Darkink\AuthorizationServer\Policy;
use Darkink\AuthorizationServer\Repositories\GroupRepository;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;

class GroupController
{
    use HasSorting, HasSearch;

    protected GroupRepository $repo;

    public function __construct(GroupRepository $repo)
    {
        $this->repo = $repo;
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
        $all_groups = $this->repo->gets()->all()->map(fn ($p) => ['value' => 'g' . $p->id, 'item' => ['caption' => $p->display_name, 'type' => 'group'], 'order' => $p->name]);
        $all_users = Policy::user()->all()->map(fn ($p) => ['value' => 'u' . $p->id, 'item' => ['caption' => $p->name, 'type' => 'user'], 'order' => $p->name]);
        $all_groups_users = array_merge($all_groups->toArray(), $all_users->toArray());
        usort($all_groups_users, fn ($a, $b) => strcmp($a['order'], $b['order']));

        return view('policy-ui::Group.create', [
            'all_groups' => $all_groups,
            'all_groups_users' => $all_groups_users
        ]);
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

        $all_groups = $this->repo->gets()->all()->map(fn ($p) => ['value' => 'g' . $p->id, 'item' => ['caption' => $p->display_name, 'type' => 'group'], 'order' => $p->name]);
        $all_users = Policy::user()->all()->map(fn ($p) => ['value' => 'u' . $p->id, 'item' => ['caption' => $p->name, 'type' => 'user' ], 'order' => $p->name]);
        $all_groups_users = array_merge($all_groups->toArray(), $all_users->toArray());
        usort($all_groups_users, fn ($a, $b) => strcmp($a['order'], $b['order']));

        return view('policy-ui::Group.update', [
            'item' => $group,
            'all_groups' => $all_groups,
            'all_groups_users' => $all_groups_users
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
}
