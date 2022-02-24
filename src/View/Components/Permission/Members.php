<?php

namespace Darkink\AuthorizationServerUI\View\Components\Permission;

use Darkink\AuthorizationServer\Repositories\PermissionRepository;
use Illuminate\View\Component;

class Members extends Component
{

    private PermissionRepository $_permissionRepository;

    public string $id;
    public string $name;
    public string $modalTitle;
    public mixed $items;
    public string $addCaption;
    public string $removeCaption;
    public mixed $values;
    public bool $remapOldValues;

    public function __construct(
        PermissionRepository $permissionRepository,
        string $id = '',
        string $name = '',
        mixed $items = [],
        mixed $values = [],
        string $modalTitle = 'title',
        string $addCaption = 'add',
        string $removeCaption = 'remove',
        bool $remapOldValues = false
    ) {
        $this->_permissionRepository = $permissionRepository;

        $this->id = $id;
        $this->name = $name;
        $this->modalTitle = $modalTitle;
        $this->items = $items;
        $this->addCaption = $addCaption;
        $this->removeCaption = $removeCaption;
        $this->values = $values;
        $this->remapOldValues = $remapOldValues;

        $this->items = $this->_permissionRepository->gets()->get()->map(fn ($p) => ['value' => $p->id, 'item' => ['caption' => $p->name], 'order' => $p->name]);
    }

    public function render()
    {
        return view('policy-ui::components.permission.members');
    }
}
