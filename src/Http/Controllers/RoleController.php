<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\Role\StoreRoleRequest;
use Darkink\AuthorizationServer\Http\Requests\Role\UpdateRoleRequest;
use Darkink\AuthorizationServer\Models\Role;
use Darkink\AuthorizationServer\Repositories\RoleRepository;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;

class RoleController
{
    use HasSorting, HasSearch;

    protected RoleRepository $repo;

    public function __construct(RoleRepository $repo)
    {
        $this->repo = $repo;
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
            $validated['label'],
            $validated['description']
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
            $validated['label'],
            $validated['description']
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
}
