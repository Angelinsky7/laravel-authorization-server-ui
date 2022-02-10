<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Http\Requests\Resource\StoreResourceRequest;
use Darkink\AuthorizationServer\Http\Requests\Resource\UpdateResourceRequest;
use Darkink\AuthorizationServer\Models\Resource;
use Darkink\AuthorizationServer\Repositories\ResourceRepository;
use Darkink\AuthorizationServerUI\Traits\HasSearch;
use Darkink\AuthorizationServerUI\Traits\HasSorting;

class ResourceController
{
    use HasSorting, HasSearch;

    protected ResourceRepository $repo;

    public function __construct(ResourceRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $items = $this->repo->gets()->query();
        $items = $this->addSearchToQueryModel($items);
        $items = $this->addOrderByToQueryModel($items);
        $items = $items->paginate(25)->withQueryString();

        return view('policy-ui::Resource.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('policy-ui::Resource.create');
    }

    public function store(StoreResourceRequest $request)
    {
        $validated = $request->validated();

        $this->repo->create(
            $validated['name'],
            $validated['display_name'],
            $validated['type'],
            $validated['icon_uri'],
            $validated['uris'] ?? [],
            $validated['scopes'] ?? []
        );

        $request->session()->flash('success_message', 'Resource created.');
        return redirect()->route('policy-ui.resource.index');
    }

    public function edit(Resource $resource)
    {
        return view('policy-ui::Resource.update', [
            'item' => $resource
        ]);
    }

    public function update(UpdateResourceRequest $request, Resource $resource)
    {
        $validated = $request->validated();

        $this->repo->update(
            $resource,
            $validated['name'],
            $validated['display_name'],
            $validated['type'],
            $validated['icon_uri'],
            $validated['uris'] ?? [],
            $validated['scopes'] ?? []
        );

        $request->session()->flash('success_message', 'Resource updated.');
        return redirect()->route('policy-ui.resource.index');
    }

    public function delete(Resource $resource)
    {
        return view('policy-ui::Resource.delete', [
            'item' => $resource
        ]);
    }

    public function destroy(Resource $resource)
    {
        $this->repo->delete($resource);

        request()->session()->flash('success_message', 'Resource deleted.');
        return redirect()->route('policy-ui.resource.index');
    }
}
