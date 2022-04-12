<?php

namespace Darkink\AuthorizationServerUI\View\Components\User;

use App\Models\User;
use Darkink\AuthorizationServer\Repositories\UserRepository;
use Darkink\AuthorizationServerUI\View\Components\Shared\Select as SharedSelect;

class Select extends SharedSelect
{
    public function __construct(
        UserRepository $userRepository,
        string $id = '',
        string $name = '',
        User | string | int | null $value = null,
        string $placeholder = '',
        bool $required = false,
        string | null $panelMaxHeight = null,
        bool $disableHiddenInput = false,
        bool $initialValueControlFromJs = false,
        string $jsId = '',
        array $options = []
    ) {
        $options = $userRepository->gets()->all()->map(fn ($p) => ['value' => $p->id, 'caption' => $p->name]);

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
