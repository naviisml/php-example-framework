<?php

namespace Navel\Helpers;

use Navel\Foundation\Application;

class Helper
{
    protected static $app;

    public static function __callStatic( $method, $args )
    {
        $instance = self::getHelperInstance();

        return $instance;

        //return $instance->$method(...$args);
    }

    public static function setAppInstance( Application $app )
    {
        self::$app = $app;
    }

    public static function getHelperInstance()
    {
        print_r('Test');
        print_r( self::getHelperAccessor() );
    }

    public static function getHelperAccessor()
    {
        // throw new Exception
    }
}
