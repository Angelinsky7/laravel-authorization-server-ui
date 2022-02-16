<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class Progress extends Component
{
    public int $value;
    public bool $inderterminate;

    public function __construct(bool $inderterminate = true, int $value = 0)
    {
        $this->value = $value;
        $this->inderterminate = $inderterminate;
    }

    public function render()
    {
        return view('policy-ui::components.shared.progress');
    }
}
