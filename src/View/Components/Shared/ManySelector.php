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
    public mixed $valueIds = [];

    public string $keyEntityAccessor;
    public string $value;
    public string $caption;

    public function __construct(
        string $id,
        string $name,
        string $placeholder = '',
        bool $required = false,
        string | null $panelMaxHeight = null,
        mixed $options = [],
        mixed $valueIds = [],
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
        $this->valueIds = $valueIds;

        $this->key = $key;
        $this->caption = $caption;

        // $this->valuesIds = $this->mapValuesToIds($values, $keyEntityAccessor);
        // //TODO(demarco): Please simply only use valueIds directly.... hanlde 3 list only all possible values (object), available ids and selected ids....
        // $this->values = $this->useOptionObjectFromIds($this->valuesIds, $options, $value);
    }

    // protected function mapValuesToIds($values, $key)
    // {
    //     if ($values == null || count($values) == 0) {
    //         return $values;
    //     }
    //     if (is_int($values[0]) || is_string($values[0])) {
    //         return $values;
    //     }
    //     return array_map(fn ($p) => $p[$key], $values);
    // }

    // protected function useOptionObjectFromIds(mixed $valueIds, mixed $options, string $value)
    // {

    //     if ($valueIds == null || count($valueIds) == 0) {
    //         return [];
    //     }

    //     if ($options == null || count($options) == 0) {
    //         return [];
    //     }

    //     $result = array_filter($options, fn ($p) => in_array($p[$value], $valueIds));
    //     return array_values($result);
    // }

    public function render()
    {
        return view('policy-ui::components.shared.many-selector');
    }
}
