<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class Listbox extends Component
{
    public string $id;
    public string $name;
    public mixed $items;

    public function __construct(
        string $id = '',
        string $name = '',
        mixed $items = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->items = $items;
    }

    public function render()
    {
        return view('policy-ui::components.shared.listbox');
    }
}
