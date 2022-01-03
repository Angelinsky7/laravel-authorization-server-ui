<?php

namespace Darkink\AuthorizationServerUI\View\Components;

use Illuminate\View\Component;

class FormFieldError extends Component
{
    public string $field;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function render()
    {
        return view('policy-ui::components.form-field-error');
    }

}
