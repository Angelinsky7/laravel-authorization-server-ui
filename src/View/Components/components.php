<?php

namespace Darkink\AuthorizationServerUI\View\Components;

$buttons = [
    ButtonRaised::class,
    ButtonStroked::class,
    ButtonDot::class,
    ButtonIcon::class,
    ButtonCancel::class,
    ButtonSubmit::class,
];

$table = [
    Table::class,
    TableSortHeader::class,
    TableSearch::class
];

$dropdown = [
    Dropdown::class,
    DropdownLink::class,
];

$miscs = [
    IconBoolTick::class,
    FormFieldError::class,
    SuccessMessage::class
];

return array_merge(
    $buttons,
    $table,
    $dropdown,
    $miscs,
    require(__DIR__ . '/Shared/components.php'),
    require(__DIR__ . '/Permission/components.php'),
    require(__DIR__ . '/Resource/components.php'),
    require(__DIR__ . '/Scope/components.php'),
);
