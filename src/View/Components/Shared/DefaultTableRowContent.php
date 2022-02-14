<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class DefaultTableRowContent extends Component
{
    public string | null $content_caption;
    public string $content_class;

    public function __construct(string | null $content = null, string $contentClass = '')
    {
        $this->content_caption = $content;
        $this->content_class = $contentClass;
    }

    public function render()
    {
        return view('policy-ui::components.shared.default-table-row-content');
    }
}
