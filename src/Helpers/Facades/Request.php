<?php

namespace Navel\Helpers\Facades;

use Navel\Helpers\Facades\Facade;

class Request extends Facade
{
    public static function __callStatic( $method, $args )
    {
        $instance = new \Navel\Helpers\Request();

        return $instance->$method( ...$args );
    }
}
