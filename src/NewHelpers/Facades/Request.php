<?php

namespace Navel\Helpers\Facades;

class Request
{
    public static function __callStatic( $method, $args )
    {
        $instance = \Navel\Helpers\Request::class;

        return $instance->$method( ...$args );
    }
}
