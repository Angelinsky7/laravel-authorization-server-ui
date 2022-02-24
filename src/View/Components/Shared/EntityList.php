<?php

namespace Darkink\AuthorizationServerUI\View\Components\Shared;

use Illuminate\View\Component;

class EntityList extends Component
{
    public string $id;
    public string $name;
    public string $modalTitle;
    public mixed $items;
    public string $addCaption;
    public string $removeCaption;
    public mixed $values;
    public bool $remapOldValues;
    public string $addCancelCaption;
    public string $addAddCaption;
    public string $deleteTitle;
    public string $deleteContent;
    public string $deleteActionCaption;
    public string $addDialogTitle;
    public string $deleteDialogTitle;

    public function __construct(
        string $id = '',
        string $name = '',
        mixed $items = [],
        mixed $values = [],
        string $modalTitle = 'Title',
        string $addCaption = 'Add',
        string $removeCaption = 'Remove',
        bool $remapOldValues = false,
        string $addCancelCaption = 'Cancel',
        string $addAddCaption = 'Add',
        string $deleteTitle = 'Title',
        string $deleteContent = 'Content',
        string $deleteActionCaption = 'Remove',
        string $addDialogTitle = '',
        string $deleteDialogTitle = ''
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->modalTitle = $modalTitle;
        $this->items = $items;
        $this->addCaption = $addCaption;
        $this->removeCaption = $removeCaption;
        $this->values = $values;
        $this->remapOldValues = $remapOldValues;
        $this->addCancelCaption = $addCancelCaption;
        $this->addAddCaption = $addAddCaption;
        $this->deleteTitle = $deleteTitle;
        $this->deleteContent = $deleteContent;
        $this->deleteActionCaption = $deleteActionCaption;
        $this->addDialogTitle = $addDialogTitle;
        $this->deleteDialogTitle = $deleteDialogTitle;
    }

    public function render()
    {
        return view('policy-ui::components.shared.entity-list');
    }
}
