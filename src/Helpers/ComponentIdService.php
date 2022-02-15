<?php

namespace Darkink\AuthorizationServerUI\Helpers;

class ComponentIdService
{
    private static $instance = null;
    private $ids = [];

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (static::$instance == null) {
            static::$instance = new ComponentIdService();
        }

        return static::$instance;
    }

    public function getId($expression)
    {
        if (!array_key_exists($expression, $this->ids)) {
            $this->ids[$expression] = 0;
        }
        $result = $this->ids[$expression]++;
        return $result;
    }
}
