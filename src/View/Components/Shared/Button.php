<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class Button extends Component
{
    public ButtonColor | null $color;
    public ButtonType | null $genre;
    public bool $is_icon;

    public function __construct(
        ButtonColor | string | null $color = ButtonColor::Basic,
        ButtonType | string | null $genre = ButtonType::Basic,
    ) {
        $this->color = $color != null && is_string($color) ? ButtonColor::tryFrom($color) : $color;
        $this->genre = $genre != null && is_string($genre) ? ButtonType::tryFrom($genre) : $genre;
        $this->is_icon = $this->genre == ButtonType::Icon;
    }

    public function render()
    {
        return view('policy-ui::components.shared.button');
    }
}
