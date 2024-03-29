<?php

namespace Navel\Helpers\Facades;

class Facade
{
    /**
     * [__callStatic description]
     *
     * @param  [type] $method [description]
     * @param  [type] $args   [description]
     * @return [type]         [description]
     */
    public static function __callStatic( $method, $args )
    {
        $instance = ( new self::$facade );

        return $instance->$method( ...$args );
    }
}
