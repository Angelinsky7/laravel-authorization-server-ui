<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class DefaultHeader extends Component
{
    public string | null $header_caption;

    public function __construct(string | null $header = null)
    {
        $this->header_caption = $header;
    }

    public function render()
    {
        return view('policy-ui::components.shared.default-header');
    }
}
