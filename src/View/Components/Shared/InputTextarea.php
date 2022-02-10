<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class InputTextarea extends Component
{

    public string $id;
    public string $name;
    public int $rows;
    public string $placeholder;
    public string $value;

    public function __construct(string $id, string $name, int $rows = 3, string $placeholder = '', mixed $value = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->rows = $rows;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    public function render()
    {
        return view('policy-ui::components.shared.input-textarea');
    }
}
