<?php

namespace Darkink\AuthorizationServerUI\View\Components\Group;

use Illuminate\View\Component;

class Members extends Component
{

    public string $id;
    public string $name;
    public string $modalTitle;
    public mixed $items;
    public string $addCaption;
    public string $removeCaption;
    public mixed $values;
    public bool $remapOldValues;

    public function __construct(
        string $id = '',
        string $name = '',
        mixed $items = [],
        mixed $values = [],
        string $modalTitle = 'title',
        string $addCaption = 'add',
        string $removeCaption = 'remove',
        bool $remapOldValues = false
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->modalTitle = $modalTitle;
        $this->items = $items;
        $this->addCaption = $addCaption;
        $this->removeCaption = $removeCaption;
        $this->values = $values;
        $this->remapOldValues = $remapOldValues;
    }

    public function render()
    {
        return view('policy-ui::components.group.members');
    }
}
