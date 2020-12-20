<?php

namespace Navel\Helpers\Facades;

use Navel\Foundation\Application;

class Facade
{
    /**
     * [protected description]
     *
     * @var [type]
     */
    protected static $app;

    /**
     * [__callStatic description]
     *
     * @param  [type] $method [description]
     * @param  [type] $args   [description]
     * @return [type]         [description]
     */
    public static function __callStatic( $method, $args )
    {
        $instance = self::resolveHelperInstance( self::getHelperInstance() );

        return $instance->$method( ...$args );
    }

    /**
     * [setAppInstance description]
     *
     * @param Application $app [description]
     */
    public static function setFacadeInstance( Application $app )
    {
        self::$app = $app;
    }

    /**
     * [getFacadeInstance description]
     *
     * @return [type] [description]
     */
    public static function getFacadeInstance()
    {
        return self::$app;
    }

    /**
     * [getHelperInstance description]
     *
     * @return [type] [description]
     */
    public static function getHelperInstance()
    {
        // throw new Exception
    }

    /**
     * [resolveHelperInstance description]
     *
     * @param  [type] $instance [description]
     * @return [type]           [description]
     */
    public static function resolveHelperInstance( $instance )
    {
        if( is_object( $instance ) ) {
            return $instance;
        }

        if( self::$app ) {
            return self::$app->make( $instance );
        }
    }
}
