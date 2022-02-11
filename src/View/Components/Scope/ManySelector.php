<?php

namespace Darkink\AuthorizationServerUI\View\Components\Scope;

use Darkink\AuthorizationServer\Repositories\ScopeRepository;
use Darkink\AuthorizationServerUI\View\Components\Shared\ManySelector as SharedManySelector;

class ManySelector extends SharedManySelector
{
    public function __construct(ScopeRepository $scopeRepository, string $id, string $name, mixed $values, string $placeholder = '', bool $required = false, string | null $panelMaxHeight = null, mixed $options = [], string $key = 'id', bool $empty = false)
    {
        if ($empty) {
            $options = [];
        } else {
            $options = $scopeRepository->gets()->all()->map(fn ($p) => ['value' => $p->id, 'caption' => $p->display_name]);
            $options = $options->toArray();
        }
        $values = is_null($values) || is_array($values) ? $values : $values->toArray();

        parent::__construct($id, $name, $values, $placeholder, $required, $panelMaxHeight, $options, $key);
    }
}
