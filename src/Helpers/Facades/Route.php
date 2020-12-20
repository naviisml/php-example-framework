<?php

namespace Navel\Helpers\Facades;

use Navel\Helpers\Facades\Facade;

class Route extends Facade
{
    public static function getHelperInstance()
    {
        return 'router';
    }

    public static function __callStatic( $method, $args )
    {
        $instance = self::resolveHelperInstance( self::getHelperInstance() );

        return $instance->$method( ...$args );
    }
}
