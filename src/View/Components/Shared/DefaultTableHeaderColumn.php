<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class DefaultTableHeaderColumn extends Component
{
    public string | null $header_caption;
    public string $content_class;

    public function __construct(string | null $header = null, string $contentClass = '')
    {
        $this->header_caption = $header;
        $this->content_class = $contentClass;
    }

    public function render()
    {
        return view('policy-ui::components.shared.default-table-header-column');
    }
}
