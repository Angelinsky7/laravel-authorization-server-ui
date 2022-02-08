<?php

namespace Darkink\AuthorizationServerUI\View\Components;

use Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor;
use Illuminate\View\Component;

abstract class Button extends Component
{

    public ButtonColor $color;
    public string $caption;
    public string $type;

    public function __construct(ButtonColor | string $color, string $caption, string $type = 'submit')
    {
        $this->color = is_string($color) ? ButtonColor::tryFrom($color) : $color;
        $this->caption = $caption;
        $this->type = $type;
    }
}
