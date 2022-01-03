<?php

namespace Darkink\AuthorizationServerUI\View\Components;

use Illuminate\View\Component;

class SuccessMessage extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('policy-ui::components.success-message');
    }

}
