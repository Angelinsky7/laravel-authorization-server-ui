<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class Link extends Button
{
    public function __construct(
        ButtonColor | string | null $color = ButtonColor::Basic,
        ButtonType | string | null $genre = ButtonType::Basic,
    ) {
        parent::__construct($color, $genre);
    }

    public function render()
    {
        return view('policy-ui::components.shared.link');
    }
}
