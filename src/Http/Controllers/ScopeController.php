<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\Scope\StoreScopeRequest;
use Darkink\AuthorizationServer\Http\Requests\Scope\UpdateScopeRequest;
use Darkink\AuthorizationServer\Models\Scope;
use Darkink\AuthorizationServer\Repositories\ScopeRepository;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;

class ScopeController
{
    use HasSorting, HasSearch;

    protected ScopeRepository $repo;

    public function __construct(ScopeRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $items = $this->repo->gets()->query();
        $items = $this->addSearchToQueryModel($items);
        $items = $this->addOrderByToQueryModel($items);
        $items = $items->paginate(25)->withQueryString();

        return view('policy-ui::Scope.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('policy-ui::Scope.create');
    }

    public function store(StoreScopeRequest $request)
    {
        $validated = $request->validated();

        $this->repo->create(
            $validated['name'],
            $validated['display_name'],
            $validated['icon_uri'],
        );

        $request->session()->flash('success_message', 'Scope created.');
        return redirect()->route('policy-ui.scope.index');
    }

    public function edit(Scope $scope)
    {
        return view('policy-ui::Scope.update', [
            'item' => $scope
        ]);
    }

    public function update(UpdateScopeRequest $request, Scope $scope)
    {
        $validated = $request->validated();
        $this->repo->update(
            $scope,
            $validated['name'],
            $validated['display_name'],
            $validated['icon_uri'],
        );

        $request->session()->flash('success_message', 'Scope updated.');
        return redirect()->route('policy-ui.scope.index');
    }

    public function delete(Scope $scope)
    {
        return view('policy-ui::Scope.delete', [
            'item' => $scope
        ]);
    }

    public function destroy(Scope $scope)
    {
        $this->repo->delete($scope);

        request()->session()->flash('success_message', 'Scope deleted.');
        return redirect()->route('policy-ui.scope.index');
    }
}
