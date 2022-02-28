<?php

namespace Darkink\AuthorizationServerUI\View\Components\Role;

use Darkink\AuthorizationServer\Repositories\RoleRepository;
use Darkink\AuthorizationServerUI\View\Components\Shared\EntityList as SharedEntityList;

class EntityList extends SharedEntityList
{
    public function __construct(
        RoleRepository $roleRepository,
        string $id = '',
        string $name = '',
        mixed $items = [],
        mixed $values = [],
        string | null $modalTitle = null,
        string | null $addCaption = null,
        string | null $removeCaption = null,
        bool $remapOldValues = false,
        string | null $addCancelCaption = null,
        string | null $addAddCaption = null,
        string | null $deleteTitle = null,
        string | null $deleteContent = null,
        string | null $deleteActionCaption = null,
        string | null $addDialogTitle = null,
        string | null $deleteDialogTitle = null
    ) {
        parent::__construct(
            $id,
            $name,
            $items,
            $values,
            $modalTitle ?? _('Add role'),
            $addCaption ?? _('Add role'),
            $removeCaption ?? _('Remove role'),
            $remapOldValues,
            $addCancelCaption ?? _('Cancel'),
            $addAddCaption ?? _('Add'),
            $deleteTitle ?? _('Remove role'),
            $deleteContent ?? _('Are you sure you want to delete this role ? This action cannot be undone.'),
            $deleteActionCaption ?? _('Remove'),
            $addDialogTitle ?? '',
            $deleteDialogTitle ?? ''
        );

        if (count($this->items) == 0) {
            $this->items = $roleRepository->gets()->get()->map(fn ($p) => ['value' => $p->id, 'item' => ['caption' => $p->name], 'order' => $p->name]);
        }
    }

    public function render()
    {
        return view('policy-ui::components.role.entity-list');
    }

}
