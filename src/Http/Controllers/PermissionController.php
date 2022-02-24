<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\Permission\StorePermissionRequest;
use Darkink\AuthorizationServer\Http\Requests\Permission\StoreResourcePermissionRequest;
use Darkink\AuthorizationServer\Http\Requests\Permission\StoreScopePermissionRequest;
use Darkink\AuthorizationServer\Http\Requests\Permission\UpdateResourcePermissionRequest;
use Darkink\AuthorizationServer\Http\Requests\Permission\UpdateScopePermissionRequest;
use Darkink\AuthorizationServer\Models\DecisionStrategy;
use Darkink\AuthorizationServer\Models\Permission;
use Darkink\AuthorizationServer\Models\ResourcePermission;
use Darkink\AuthorizationServer\Models\ScopePermission;
use Darkink\AuthorizationServer\Repositories\PermissionRepository;
use Darkink\AuthorizationServer\Repositories\ResourcePermissionRepository;
use Darkink\AuthorizationServer\Repositories\ScopePermissionRepository;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;
use Exception;
use Illuminate\Http\Request;

class PermissionController
{

    use HasSorting, HasSearch;

    protected PermissionRepository $permissionRepository;
    protected ScopePermissionRepository $scopePermissionRepository;
    protected ResourcePermissionRepository $resourcePermissionRepository;

    public function __construct(
        PermissionRepository $permissionRepository,
        ScopePermissionRepository $scopePermissionRepository,
        ResourcePermissionRepository $resourcePermissionRepository
    ) {
        $this->permissionRepository = $permissionRepository;
        $this->scopePermissionRepository = $scopePermissionRepository;
        $this->resourcePermissionRepository = $resourcePermissionRepository;
    }

    public function index()
    {
        $items = $this->permissionRepository->gets();
        $items = $this->addSearchToQueryModel($items);
        $items = $this->addOrderByToQueryModel($items);
        $items = $items->paginate(25)->withQueryString();

        return view('policy-ui::Permission.index', [
            'items' => $items
        ]);
    }

    public function create(Request $request)
    {
        $type = $request->query('type');
        switch ($type) {
            case "scope":
                return view('policy-ui::Permission.Scope.create');
            case "resource":
                return view('policy-ui::Permission.Resource.create');
        }
        return view('policy-ui::Permission.create');
    }

    // public function createScope()
    // {
    //     return view('policy-ui::Permission.Scope.create');
    // }

    // public function createResource()
    // {
    //     return view('policy-ui::Permission.Resource.create');
    // }

    public function store(Request $request)
    {
        switch ($request->query('type')) {
            case "scope":
                return $this->storeScope(StoreScopePermissionRequest::createFrom($request));
            case "resource":
                return $this->storeResource(StoreResourcePermissionRequest::createFrom($request));
        }
        throw new Exception('Invaid type given');
    }

    public function storeScope(StoreScopePermissionRequest $request)
    {
        $validated = $request->validate($request->rules());

        $this->scopePermissionRepository->create(
            $validated['name'],
            $validated['description'],
            $validated['decision_strategy'],
            $validated['resource'],
            $validated['scopes']
        );

        $request->session()->flash('success_message', 'Scope Permission created.');
        return redirect()->route('policy-ui.permission.index');
    }

    public function storeResource(StoreResourcePermissionRequest $request)
    {
        $validated = $request->validate($request->rules());

        $this->resourcePermissionRepository->create(
            $validated['name'],
            $validated['description'],
            $validated['decision_strategy'],
            $validated['resource_type'],
            $validated['resource'],
        );

        $request->session()->flash('success_message', 'Resource permission created.');
        return redirect()->route('policy-ui.permission.index');
    }

    public function edit(Permission $permission)
    {
        switch (get_class($permission->permission)) {
            case ScopePermission::class:
                return view('policy-ui::Permission.Scope.update', [
                    'item' => $permission->permission
                ]);
                break;
            case ResourcePermission::class:
                return view('policy-ui::Permission.Resource.update', [
                    'item' => $permission->permission
                ]);
                break;
        }
        return view('policy-ui::Permission.update', [
            'item' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        switch ($request->query('type')) {
            case "scope":
                return $this->updateScope(UpdateScopePermissionRequest::createFrom($request), $permission->permission);
            case "resource":
                return $this->updateResource(UpdateResourcePermissionRequest::createFrom($request), $permission->permission);
        }
        throw new Exception('Invaid type given');
    }

    public function updateScope(UpdateScopePermissionRequest $request, ScopePermission $permission)
    {
        $validated = $request->validate($request->rules());

        $this->scopePermissionRepository->update(
            $permission,
            $validated['name'],
            $validated['description'],
            $validated['decision_strategy'],
            $validated['resource'],
            $validated['scopes']
        );

        $request->session()->flash('success_message', 'Scope Permission updated.');
        return redirect()->route('policy-ui.permission.index');
    }

    public function updateResource(UpdateResourcePermissionRequest $request, ResourcePermission $permission)
    {
        $validated = $request->validate($request->rules());

        $this->resourcePermissionRepository->update(
            $permission,
            $validated['name'],
            $validated['description'],
            $validated['decision_strategy'],
            $validated['resource_type'],
            $validated['resource'],
        );

        $request->session()->flash('success_message', 'Resource Permission updated.');
        return redirect()->route('policy-ui.permission.index');
    }


    public function delete(Permission $permission)
    {
        return view('policy-ui::Permission.delete', [
            'item' => $permission
        ]);
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $this->permissionRepository->delete($permission);

        request()->session()->flash('success_message', 'Permission deleted.');
        return redirect()->route('policy-ui.permission.index');
    }
}
