<?php

namespace Darkink\AuthorizationServerUI\View\Components\Client;

use App\Models\Client;
use Darkink\AuthorizationServer\Repositories\ClientRepository;
use Darkink\AuthorizationServerUI\View\Components\Shared\Select as SharedSelect;

class Select extends SharedSelect
{
    public function __construct(
        ClientRepository $clientRepository,
        string $id = '',
        string $name = '',
        Client | string | int | null $value = null,
        string $placeholder = '',
        bool $required = false,
        string | null $panelMaxHeight = null,
        bool $disableHiddenInput = false,
        bool $initialValueControlFromJs = false,
        string $jsId = '',
        array $options = []
    ) {
        $options = $clientRepository->gets()->get()->map(fn ($p) => ['value' => $p->id, 'caption' => $p->name]);

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
            $options->toArray(),
        );
    }
}
