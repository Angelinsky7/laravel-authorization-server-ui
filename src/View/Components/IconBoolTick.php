<?php

namespace Darkink\AuthorizationServerUI\View\Components;

use Illuminate\View\Component;

class IconBoolTick extends Component
{

    public bool $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function render()
    {
        return view('policy-ui::components.icon-bool-tick');
    }
}
