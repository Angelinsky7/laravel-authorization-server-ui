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

    public mixed $options;
    public mixed $values;

    public function __construct(string $id, string $name, mixed $values, string $placeholder = '', bool $required = false, string | null $panelMaxHeight = null, mixed $options = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->required = $required;

        $this->panelMaxHeight = $panelMaxHeight;

        $this->options = $options;
        $this->values = $this->findCorrectValuesFromOptions($values, $options);
    }

    protected function findCorrectValuesFromOptions(mixed $values, mixed $options)
    {
        if ($values == null || count($values) == 0) {
            return $values;
        }
        if ($options == null || count($options) == 0) {
            return $values;
        }
        if (is_object($values[0])) {
            return $values;
        }
        $result = array_filter($options, fn ($p) => in_array($p['value'], $values));
        return array_values($result);
    }

    public function render()
    {
        return view('policy-ui::components.shared.many-selector');
    }
}
