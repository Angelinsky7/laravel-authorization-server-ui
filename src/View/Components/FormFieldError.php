<?php

namespace Darkink\AuthorizationServerUI\View\Components;

use Illuminate\View\Component;

class FormFieldError extends Component
{
    public string $field;
    public string $js;
    public bool $subfields;

    public function __construct(
        string $field = '',
        string $js = '',
        bool $subfields = false
    ) {
        $this->field = $field;
        $this->js = $js;
        $this->subfields = $subfields;
    }

    public function render()
    {
        return view('policy-ui::components.form-field-error');
    }
}
