<?php

namespace Navel\Helpers\Facades;

use Navel\Helpers\Facades\Facade;

class ArgvInput extends Facade
{
    /**
     * [protected description]
     *
     * @var [type]
     */
    protected static $facade = \Navel\Helpers\Console\ArgvInput::class;

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
