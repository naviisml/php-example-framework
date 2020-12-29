<?php

namespace Navel\Helpers\Facades;

use Navel\Helpers\Facades\Facade;

class Example extends Facade
{
    public static function __callStatic( $method, $args )
    {
        $instance = new \Navel\Helpers\Example();

        return $instance->$method( ...$args );
    }
}
