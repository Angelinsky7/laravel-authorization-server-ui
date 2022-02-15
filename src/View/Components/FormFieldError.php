<?php

namespace Darkink\AuthorizationServerUI\View\Components;

use Illuminate\View\Component;

class FormFieldError extends Component
{
    public string $field;
    public string $js;

    public function __construct(
        string $field = '',
        string $js = ''
    ) {
        $this->field = $field;
        $this->js = $js;
    }

    public function render()
    {
        return view('policy-ui::components.form-field-error');
    }
}
