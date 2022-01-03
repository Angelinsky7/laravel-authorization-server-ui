<?php

namespace Darkink\AuthorizationServerUI\View\Components;

use Illuminate\View\Component;

class ButtonCancel extends Component
{

    public string $route;

    public function __construct(string $route)
    {
        $this->route = $route;
    }

    public function render()
    {
        return view('policy-ui::components.button-cancel');
    }

}
