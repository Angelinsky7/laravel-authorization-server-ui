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
    public string $jsId;

    public string | null $panelMaxHeight;
    public bool $disableHiddenInput;
    public bool $initialValueControlFromJs;

    public mixed $options;
    public mixed $value;

    public function __construct(
        string $id = '',
        string $name = '',
        mixed $value = null,
        string $placeholder = '',
        bool $required = false,
        string | null $panelMaxHeight = null,
        bool $disableHiddenInput = false,
        bool $initialValueControlFromJs = false,
        string $jsId = '',
        array $options = [],
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->required = $required;

        $this->panelMaxHeight = $panelMaxHeight;
        $this->disableHiddenInput = $disableHiddenInput;
        $this->initialValueControlFromJs = $initialValueControlFromJs;

        $this->jsId = "+$jsId";

        $this->options = $options;
        $this->value = $value;
    }

    public function render()
    {
        return view('policy-ui::components.shared.select');
    }
}
