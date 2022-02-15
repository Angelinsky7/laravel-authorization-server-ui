<?php

namespace Darkink\AuthorizationServerUI\View\Directives;

use Darkink\AuthorizationServerUI\Helpers\ComponentIdService;

class ComponentId
{
    public static function execute($expression)
    {
        return ComponentIdService::getInstance()->getId($expression);
    }
}
