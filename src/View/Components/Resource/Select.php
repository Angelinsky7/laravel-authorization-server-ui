<?php

namespace Darkink\AuthorizationServerUI\View\Components\Resource;

use Darkink\AuthorizationServer\Models\Resource;
use Darkink\AuthorizationServer\Repositories\ResourceRepository;
use Darkink\AuthorizationServerUI\View\Components\Shared\Select as SharedSelect;
use Illuminate\View\Component;

class Select extends SharedSelect
{
    public function __construct(
        ResourceRepository $resourceRepository,
        string $id = '',
        string $name = '',
        Resource | string | int | null $value = null,
        string $placeholder = '',
        bool $required = false,
        string | null $panelMaxHeight = null,
        bool $disableHiddenInput = false,
        bool $initialValueControlFromJs = false,
        string $jsId = '',
        array $options = []
    ) {
        $options = $resourceRepository->gets()->all()->map(fn ($p) => ['value' => $p->id, 'caption' => $p->display_name, 'scopes' => $p->scopes()->get()]);

        parent::__construct(
            $id,
            $name,
            $value != null && is_object($value) ? $value->id : $value,
            $placeholder,
            $required,
            $panelMaxHeight,
            $disableHiddenInput,
            $initialValueControlFromJs,
            $jsId,
            $options->toArray()
        );
    }
}
