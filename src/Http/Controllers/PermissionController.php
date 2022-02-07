<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\Permission\StorePermissionRequest;
use Darkink\AuthorizationServer\Http\Requests\Permission\StoreScopePermissionRequest;
use Darkink\AuthorizationServer\Models\DecisionStrategy;
use Darkink\AuthorizationServer\Models\Permission;
use Darkink\AuthorizationServer\Models\ScopePermission;
use Darkink\AuthorizationServer\Repositories\PermissionRepository;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;
use Exception;
use Illuminate\Http\Request;

class PermissionController
{

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

    public function createScope()
    {
        $decisionStrategies = array_column(DecisionStrategy::cases(), 'name');

        return view('policy-ui::Permission.Scope.create', [
            'decisionStrategies' => $decisionStrategies
        ]);
    }

    public function store(Request $request)
    {
        switch ($request->query('type')) {
            case "scope":
                return $this->storeScope(StoreScopePermissionRequest::createFrom($request));
            case "resource":
                return;
        }
        throw new Exception('Invaid type given');
    }

    public function storeScope(StoreScopePermissionRequest $request)
    {
        $request->validate($request->rules());
        $validated = $request->validated();

        var_dump($validated, get_class($request));
        exit;

        switch (get_class($request)) {
            case StoreScopePermissionRequest::class:
                $this->repo->createScope(
                    $validated['name'],
                    $validated['description'],
                    $validated['decision_stategy'],
                    $validated['resource'],
                    $validated['scopes']
                );
                break;
            case ResourcePermission::class:

                break;
        }

        $request->session()->flash('success_message', 'Permission created.');
        return redirect()->route('policy-ui.permission.index');
    }

    public function edit(Permission $permission)
    {

        $decisionStrategies = array_column(DecisionStrategy::cases(), 'name');

        switch (get_class($permission->permission)) {
            case ScopePermission::class:
                return view('policy-ui::Permission.Scope.update', [
                    'item' => $permission->permission,
                    'decisionStrategies' => $decisionStrategies,
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

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $validated = $request->validated();

        switch (get_class($permission->permission)) {
            case ScopePermission::class:
                $this->repo->updateScope(
                    $permission->permission,
                    $validated['name'],
                    $validated['description'],
                    $validated['decision_stategy'],
                    $validated['resource'],
                    $validated['scopes']
                );
                break;
            case ResourcePermission::class:

                break;
        }

        $request->session()->flash('success_message', 'Permission updated.');
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
        $this->repo->delete($permission);

        request()->session()->flash('success_message', 'Permission deleted.');
        return redirect()->route('policy-ui.permission.index');
    }
}
