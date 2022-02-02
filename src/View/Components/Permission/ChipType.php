<?php

namespace Darkink\AuthorizationServerUI\View\Components\Permission;

use Darkink\AuthorizationServer\Models\Permission;
use Darkink\AuthorizationServer\Models\ResourcePermission;
use Darkink\AuthorizationServer\Models\ScopePermission;
use Illuminate\View\Component;

class ChipType extends Component
{

    public Permission $item;
    public string $caption;
    public string $color;

    public function __construct(Permission $item)
    {
        $this->item = $item;
        $class = get_class($item->permission);
        $this->caption = $this->getCaption($class);
        $this->color = $this->getColor($class);
    }

    protected function getCaption($fullClassName)
    {
        switch ($fullClassName) {
            case ScopePermission::class:
                return _('Scope Permission');
                break;
            case ResourcePermission::class:
                return _('Resource Permission');
                break;
        }
        return _('Permission');
    }

    protected function getColor($fullClassName)
    {
        switch ($fullClassName) {
            case ScopePermission::class:
                return 'blue';
                break;
            case ResourcePermission::class:
                return 'red';
                break;
        }
        return 'green';
    }

    public function render()
    {
        return view('policy-ui::components.permission.chip-type');
    }
}
