<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class ManySelector extends Component
{
    public string $id;
    public string $name;
    public string $placeholder;
    public bool $required;

    public string | null $panelMaxHeight;

    public array $options;
    public array | null $values;

    public function __construct(string $id, string $name, array | null $values, string $placeholder = '', bool $required = false, string | null $panelMaxHeight = null, array $options = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->required = $required;

        $this->panelMaxHeight = $panelMaxHeight;

        $this->options = $options;
        $this->values = $values;
    }

    public function render()
    {
        return view('policy-ui::components.shared.many-selector');
    }
}
