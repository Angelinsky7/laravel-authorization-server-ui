<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Models\Permission;
use Darkink\AuthorizationServer\Repositories\PermissionRepository;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;

class PermissionController {

    use HasSorting, HasSearch;

    protected PermissionRepository $repo;

    public function __construct(PermissionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $items = $this->repo->gets();
        $items = $this->addSearchToQueryModel($items);
        $items = $this->addOrderByToQueryModel($items);
        $items = $items->paginate(25)->withQueryString();

        return view('policy-ui::Permission.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('policy-ui::Permission.create');
    }

    public function store(StorePermissionRequest $request)
    {
        // $validated = $request->validated();

        // $this->repo->create(
        //     $validated['name'],
        //     $validated['label'],
        //     $validated['description']
        // );

        $request->session()->flash('success_message', 'Permission created.');
        return redirect()->route('policy-ui.permission.index');
    }

    public function edit(Permission $permission)
    {
        return view('policy-ui::Permission.update', [
            'item' => $permission
        ]);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        // $validated = $request->validated();
        // $this->repo->update(
        //     $permission,
        //     $validated['name'],
        //     $validated['label'],
        //     $validated['description']
        // );

        $request->session()->flash('success_message', 'Permission updated.');
        return redirect()->route('policy-ui.permission.index');
    }

    public function delete(Permission $permission)
    {
        return view('policy-ui::Permission.delete', [
            'item' => $permission
        ]);
    }

    public function destroy(Permission $permission)
    {
        $this->repo->delete($permission);

        request()->session()->flash('success_message', 'Permission deleted.');
        return redirect()->route('policy-ui.permission.index');
    }

}
