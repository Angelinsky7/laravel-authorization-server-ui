<?php

namespace Darkink\AuthorizationServerUI\View\Components\Role;

use Darkink\AuthorizationServer\Models\Role;
use Illuminate\View\Component;

class ChipSystem extends Component
{

    public Role $item;
    public string $caption;

    public function __construct(Role $item)
    {
        $this->item = $item;
        $this->caption = $this->getCaption($this->item->system);
    }

    protected function getCaption($is_system)
    {
        if ($is_system) {
            return  _('System');
        } else {
            return _('User');
        }

        return _('Unkown role');
    }

    public function render()
    {
        return view('policy-ui::components.role.chip-system');
    }
}
