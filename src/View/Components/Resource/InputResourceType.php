<?php

namespace Darkink\AuthorizationServerUI\View\Components\Resource;

use Darkink\AuthorizationServer\Repositories\ResourceRepository;
use Illuminate\View\Component;

class InputResourceType extends Component
{

    protected ResourceRepository $resourceRepository;

    public string $id;
    public string $name;
    public mixed $value;

    public mixed $resources;

    public function __construct(
        ResourceRepository $resourceRepository,
        string $id,
        string $name,
        mixed $value
    ) {
        $this->resourceRepository = $resourceRepository;

        $this->id = $id;
        $this->name = $name;
        $this->value = $value;

        $this->resources = $resourceRepository->gets()->all();
    }

    public function render()
    {
        return view('policy-ui::components.resource.input-resource-type');
    }
}
