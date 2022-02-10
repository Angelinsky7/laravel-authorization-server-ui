<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class OuterFormLayout extends Component
{
    public function __construct()
    {
    }

    public function render()
    {
        return view('policy-ui::components.shared.outer-form-layout');
    }
}
