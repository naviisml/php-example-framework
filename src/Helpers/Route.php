<?php

namespace Navel\Helpers;

use Navel\Framework\Container\Container;

class Route
{
    /**
     * The router instance
     *
     * @var \Navel\Foundation\Router
     */
    public static $router;

    /**
     * The route method
     *
     * @var string
     */
    protected $routeMethod;

    /**
     * The route action
     *
     * @var closure
     */
    protected $routeAction;

    /**
     * The route alias
     *
     * @var string
     */
    protected $routeAlias;

    public static function getInstance()
    {
        if ( is_null( static::$router ) ) {
            static::$router = Container::getInstance()->make('router');
        }

        return static::$router;
    }

    public static function get( $uri, $callback )
    {
        $router = self::getInstance();

        $router->addRoute( "GET", $uri, $callback, $alias = null );
    }
}
