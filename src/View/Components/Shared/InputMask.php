<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class InputMask extends Component
{

    public string $id;
    public string $name;
    public string $mask;
    public string $validation;
    public string $placeholder_char;
    public string $validation_char_replacement;
    public string | null $value;

    public function __construct(
        string $id = '',
        string $name = '',
        string $mask = '',
        string $validation = '',
        string $placeholder_char = '_',
        string $validation_char_replacement = '◬',
        mixed $value = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->mask = $mask;
        $this->validation = $validation;
        $this->placeholder_char = $placeholder_char;
        $this->validation_char_replacement = $validation_char_replacement;
        $this->value = $value;
    }

    public function render()
    {
        return view('policy-ui::components.shared.input-mask');
    }
}
