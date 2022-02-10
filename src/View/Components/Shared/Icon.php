<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class Icon extends Component
{
    public IconSize $size;

    public function __construct(IconSize | string $size = 'normal')
    {
        $this->size = is_string($size) ? IconSize::tryFrom($size) : $size;
    }

    public function render()
    {
        return view('policy-ui::components.shared.icon');
    }
}
