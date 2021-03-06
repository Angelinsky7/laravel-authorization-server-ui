<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class DefaultModalContent extends Component
{

    public string | null $content_caption;

    public function __construct(string | null $content = null)
    {
        $this->content_caption = $content;
    }

    public function render()
    {
        return view('policy-ui::components.shared.default-modal-content');
    }
}
