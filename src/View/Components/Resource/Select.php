<?php

namespace Darkink\AuthorizationServerUI\View\Components\Resource;

use Darkink\AuthorizationServer\Models\Resource;
use Darkink\AuthorizationServerUI\View\Components\Shared\Select as SharedSelect;
use Illuminate\View\Component;

class Select extends SharedSelect
{
    public function __construct(string $id, string $name, Resource | string | int | null $value, string $placeholder = '', bool $required = false, array $values = [])
    {
        $values = [
            [
                'value' => 1,
                'caption' => 'One'
            ],
            [
                'value' => 2,
                'caption' => 'Two'
            ],
            [
                'value' => 3,
                'caption' => 'Three'
            ]
        ];
        parent::__construct($id, $name, $value, $placeholder, $required, $values);
    }
}
