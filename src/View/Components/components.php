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
    TableSearch::class
];

$miscs = [
    IconBoolTick::class,
    FormFieldError::class,
    FlashMessage::class
];

return array_merge(
    $buttons,
    $table,
    $miscs,
    require(__DIR__ . '/Shared/components.php'),
    require(__DIR__ . '/Permission/components.php'),
    require(__DIR__ . '/Resource/components.php'),
    require(__DIR__ . '/Scope/components.php'),
    require(__DIR__ . '/Role/components.php'),
);
