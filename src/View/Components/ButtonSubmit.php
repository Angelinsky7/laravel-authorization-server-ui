<?php

namespace Darkink\AuthorizationServerUI\View\Components;

use Illuminate\View\Component;

class ButtonSubmit extends Component
{

    public string $color;

    public function __construct(string $color = 'primary')
    {
        $this->color = $color;
    }

    public function render()
    {
        return view('policy-ui::components.button-submit');
    }
}
