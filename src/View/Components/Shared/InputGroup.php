<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class InputGroup extends Component
{

    public string | null $header_caption;
    public bool $inline;
    public bool $reverse;

    public function __construct(string | null $header = null, bool $inline = false, bool $reverse = false)
    {
        $this->header_caption = $header;
        $this->inline = $inline;
        $this->reverse = $reverse;
    }

    public function render()
    {
        if($this->inline){
            return view('policy-ui::components.shared.input-group-inline');
        }
        return view('policy-ui::components.shared.input-group');
    }
}
