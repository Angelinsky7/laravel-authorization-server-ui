<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class Tab extends Component
{
    public string $id;

    public function __construct(
        string $id = '',
    ) {
        $this->id = $id;
    }

    public function render()
    {
        return view('policy-ui::components.shared.tab');
    }
}
