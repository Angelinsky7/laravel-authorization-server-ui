<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\Group\StoreGroupRequest;
use Darkink\AuthorizationServer\Http\Requests\Group\UpdateGroupRequest;
use Darkink\AuthorizationServer\Models\Group;
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
        return view('policy-ui::Group.create');
    }

    public function store(StoreGroupRequest $request)
    {
        $validated = $request->validated();

        $this->repo->create(
            $validated['name'],
            $validated['display_name'],
            $validated['description'],
            $validated['memberOfs'] ?? [],
            $validated['members'] ?? []
        );

        $request->session()->flash('success_message', 'Group created.');
        return redirect()->route('policy-ui.Group.index');
    }

    public function edit(Group $Group)
    {
        return view('policy-ui::Group.update', [
            'item' => $Group
        ]);
    }

    public function update(UpdateGroupRequest $request, Group $Group)
    {
        $validated = $request->validated();
        $this->repo->update(
            $Group,
            $validated['name'],
            $validated['display_name'],
            $validated['description'],
            $validated['memberOfs'] ?? [],
            $validated['members'] ?? []
        );

        $request->session()->flash('success_message', 'Group updated.');
        return redirect()->route('policy-ui.group.index');
    }

    public function delete(Group $Group)
    {
        return view('policy-ui::Group.delete', [
            'item' => $Group
        ]);
    }

    public function destroy(Group $Group)
    {
        $this->repo->delete($Group);

        request()->session()->flash('success_message', 'Group deleted.');
        return redirect()->route('policy-ui.group.index');
    }
}
