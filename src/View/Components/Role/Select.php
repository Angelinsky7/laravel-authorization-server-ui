<?php

namespace Darkink\AuthorizationServerUI\View\Components\Role;

use Darkink\AuthorizationServer\Models\Role;
use Darkink\AuthorizationServer\Repositories\RoleRepository;
use Darkink\AuthorizationServerUI\View\Components\Shared\Select as SharedSelect;
use Illuminate\View\Component;

class Select extends SharedSelect
{
    public function __construct(
        RoleRepository $roleRepository,
        string $id = '',
        string $name = '',
        Role | string | int | null $value = null,
        string $placeholder = '',
        bool $required = false,
        string | null $panelMaxHeight = null,
        bool $disableHiddenInput = false,
        bool $initialValueControlFromJs = false,
        string $jsId = '',
        array $options = []
    ) {
        $options = $roleRepository->gets()->all()->map(fn ($p) => ['value' => $p->id, 'caption' => $p->display_name]);

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
