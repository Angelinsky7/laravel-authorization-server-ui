<?php

namespace Darkink\AuthorizationServerUI\View\Components\Policy;

use Darkink\AuthorizationServer\Repositories\PolicyRepository;
use Darkink\AuthorizationServerUI\View\Components\Shared\EntityList as SharedEntityList;

class EntityList extends SharedEntityList
{
    public function __construct(
        PolicyRepository $policyRepository,
        string $id = '',
        string $name = '',
        mixed $items = [],
        mixed $values = [],
        mixed $excludes = [],
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
        string | null $deleteDialogTitle = null,
        bool $excludeAlreadyAddedItems = true
    ) {
        parent::__construct(
            $id,
            $name,
            $items,
            $values,
            $excludes,
            $modalTitle ?? _('Add policy'),
            $addCaption ?? _('Add policy'),
            $removeCaption ?? _('Remove policy'),
            $remapOldValues,
            $addCancelCaption ?? _('Cancel'),
            $addAddCaption ?? _('Add'),
            $deleteTitle ?? _('Remove Policy'),
            $deleteContent ?? _('Are you sure you want to delete this policy ? This action cannot be undone.'),
            $deleteActionCaption ?? _('Remove'),
            $addDialogTitle ?? '',
            $deleteDialogTitle ?? '',
            $excludeAlreadyAddedItems
        );

        if (count($this->items) == 0) {
            $this->items = $policyRepository->gets()->get()->map(fn ($p) => ['value' => $p->id, 'item' => ['caption' => $p->name], 'order' => $p->name]);
        }
    }

    public function render()
    {
        return view('policy-ui::components.policy.entity-list');
    }
}
