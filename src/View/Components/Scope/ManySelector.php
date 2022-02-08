<?php

namespace Darkink\AuthorizationServerUI\View\Components\Scope;

use Darkink\AuthorizationServer\Repositories\ScopeRepository;
use Darkink\AuthorizationServerUI\View\Components\Shared\ManySelector as SharedManySelector;

class ManySelector extends SharedManySelector
{
    public function __construct(ScopeRepository $scopeRepository, string $id, string $name, array | null $values, string $placeholder = '', bool $required = false, string | null $panelMaxHeight = null, array $options = [])
    {
        $options = $scopeRepository->gets()->all()->map(fn ($p) => ['value' => $p->id, 'caption' => $p->display_name]);

        parent::__construct($id, $name, $values, $placeholder, $required, $panelMaxHeight, $options->toArray());
    }
}
