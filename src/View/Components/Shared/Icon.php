<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class Icon extends Component
{
    public IconSize $size;
    public ButtonColor | null $color;

    public function __construct(
        IconSize | string $size = 'normal',
        ButtonColor | string | null $color = 'basic',
    ) {
        $this->size = is_string($size) ? IconSize::tryFrom($size) : $size;
        $this->color = $color != null && is_string($color) ? ButtonColor::tryFrom($color) : $color;
    }

    public function render()
    {
        return view('policy-ui::components.shared.icon');
    }
}
