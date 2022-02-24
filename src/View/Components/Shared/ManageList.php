<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class ManageList extends Component
{
    public string $id;
    public string $name;
    public string $addCaption;
    public mixed $items;

    public function __construct(
        string $id = '',
        string $name = '',
        string | null $addCaption = null,
        mixed $items = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->addCaption = $addCaption ?? _('Add');
        $this->items = $items;
    }

    public function render()
    {
        return view('policy-ui::components.shared.manage-list');
    }
}
