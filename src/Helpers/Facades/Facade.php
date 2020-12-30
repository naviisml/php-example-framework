<?php

namespace Navel\Helpers\Facades;

class Facade
{
    public static function __callStatic( $method, $args )
    {
        $instance = new $this->facade();

        return $instance->$method( ...$args );
    }
}
