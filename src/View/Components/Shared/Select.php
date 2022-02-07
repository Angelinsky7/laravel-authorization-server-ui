<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Darkink\AuthorizationServer\Models\Resource;
use Illuminate\View\Component;

class Select extends Component
{
    public string $id;
    public string $name;
    public string $placeholder;
    public bool $required;

    public mixed $values;
    public mixed $value;

    public function __construct(string $id, string $name, mixed $value, string $placeholder = '', bool $required = false, array $values = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->required = $required;

        $this->values = $values;
        $this->value = $value;
    }

    public function render()
    {
        return view('policy-ui::components.shared.select');
    }
}
