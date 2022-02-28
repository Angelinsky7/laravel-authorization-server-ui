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

    public mixed $options = [];
    public mixed $values = [];

    public string $keyEntityAccessor;
    public string $key;
    public string $caption;

    public function __construct(
        string $id,
        string $name,
        string $placeholder = '',
        bool $required = false,
        string | null $panelMaxHeight = null,
        mixed $options = [],
        mixed $values = [],
        string $keyEntityAccessor = 'id',
        string $key = 'value',
        string $caption = 'caption'
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->required = $required;

        $this->panelMaxHeight = $panelMaxHeight;
        $this->keyEntityAccessor = $keyEntityAccessor;

        $this->options = $options;
        $this->values = $values;

        $this->key = $key;
        $this->caption = $caption;
    }

    public function render()
    {
        return view('policy-ui::components.shared.many-selector');
    }
}
