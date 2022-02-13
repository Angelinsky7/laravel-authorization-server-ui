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
    public string $class_name;

    public function __construct(Permission $item)
    {
        $this->item = $item;
        $this->class_name = get_class($item->permission);
        $this->caption = $this->getCaption($this->class_name);
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

    public function render()
    {
        return view('policy-ui::components.permission.chip-type');
    }
}
