<?php

namespace Darkink\AuthorizationServerUI\View\Directives;

class ComponentId
{
    private static $ids = [];

    public static function execute($expression)
    {
        if (!array_key_exists($expression, static::$ids)) {
            static::$ids[$expression] = 0;
        }
        return static::$ids[$expression]++;
    }
}
