<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class DefaultModalTitle extends Component
{
    public string | null $title_caption;

    public function __construct(string | null $title = null)
    {
        $this->title_caption = $title;
    }

    public function render()
    {
        return view('policy-ui::components.shared.default-modal-title');
    }
}
