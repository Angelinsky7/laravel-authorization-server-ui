<?php

namespace Darkink\AuthorizationServerUI\View\Components\Client;

use App\Models\Client;
use Darkink\AuthorizationServer\Repositories\ClientRepository;
use Darkink\AuthorizationServerUI\View\Components\Shared\EntityList as SharedEntityList;

class EntityList extends SharedEntityList
{
    public function __construct(
        ClientRepository $clientRepository,
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
            $modalTitle ?? _('Add client'),
            $addCaption ?? _('Add client'),
            $removeCaption ?? _('Remove client'),
            $remapOldValues,
            $addCancelCaption ?? _('Cancel'),
            $addAddCaption ?? _('Add'),
            $deleteTitle ?? _('Remove client'),
            $deleteContent ?? _('Are you sure you want to delete this client ? This action cannot be undone.'),
            $deleteActionCaption ?? _('Remove'),
            $addDialogTitle ?? '',
            $deleteDialogTitle ?? '',
            $excludeAlreadyAddedItems
        );

        if (count($this->items) == 0) {
            $this->items = $clientRepository->gets()->get()->map(fn (Client $p) => ['value' => $p->id, 'item' => ['caption' => $p->name], 'order' => $p->name]);
        }
    }

    public function render()
    {
        return view('policy-ui::components.client.entity-list');
    }
}
