<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class InputMask extends Component
{

    public string $id;
    public string $name;
    public string $mask;
    public string | null $value;

    public function __construct(
        string $id = '',
        string $name = '',
        string $mask = '',
        mixed $value = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->mask = $mask;
        $this->value = $value;
    }

    public function render()
    {
        return view('policy-ui::components.shared.input-mask');
    }
}
