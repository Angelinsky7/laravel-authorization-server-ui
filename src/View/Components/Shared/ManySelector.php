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

    public string $keyValue;
    public string $keyOption;

    public function __construct(string $id, string $name, mixed $values, string $placeholder = '', bool $required = false, string | null $panelMaxHeight = null, mixed $options = [], string $keyValue = 'id', string $keyOption = 'value')
    {
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->required = $required;

        $this->panelMaxHeight = $panelMaxHeight;
        $this->keyValue = $keyValue;

        $this->options = $options;
        $this->keyOption = $keyOption;

        $valuesIds = $this->mapValuesToIds($values, $keyValue);
        $this->values = $this->useOptionObjectFromIds($valuesIds, $options, $keyOption);
    }

    protected function mapValuesToIds($values, $key)
    {
        if ($values == null || count($values) == 0) {
            return $values;
        }
        if (is_int($values[0])) {
            return $values;
        }
        return array_map(fn ($p) => $p[$key], $values);
    }

    protected function useOptionObjectFromIds(mixed $valueIds, mixed $options, string $keyOption)
    {

        if ($valueIds == null || count($valueIds) == 0) {
            return [];
        }

        if ($options == null || count($options) == 0) {
            return [];
        }

        $result = array_filter($options, fn ($p) => in_array($p[$keyOption], $valueIds));
        return array_values($result);
    }

    public function render()
    {
        return view('policy-ui::components.shared.many-selector');
    }
}
