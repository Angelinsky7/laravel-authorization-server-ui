<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class ActionsFormLayout extends Component
{
    public function __construct()
    {
    }

    public function render()
    {
        return view('policy-ui::components.shared.actions-form-layout');
    }
}
