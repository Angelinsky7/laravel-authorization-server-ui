<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class InputBase extends Component
{

    public string $id;
    public string $name;
    public string $type;
    public string | null $value;

    public function __construct(
        string $id = '',
        string $name = '',
        string $type = 'text',
        mixed $value = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    public function render()
    {
        return view('policy-ui::components.shared.input-base');
    }
}
