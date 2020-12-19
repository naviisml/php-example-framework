<?php

namespace Navel\Framework\Routing;

class Router
{
    /**
     * A flattened array with all the routes
     *
     * @var array
     */
    protected $routes;

    /**
     * A array of routes keyed by method
     *
     * @var array
     */
    protected $routeMethods;

    /**
     * A list of routes keyed by alias
     *
     * @var array
     */
    protected $routeAlias;

    /**
     * A look-up table of routes by action.
     *
     * @var array
     */
    protected $routeAction;

    public function __construct()
    {

    }

    public function getRoute( $uri )
    {
        if( !$route = $this->routes[ $uri ] ) {
            throw new \Exception("[{$uri}] doesnt exist.");
        }

        $route();
    }

    public function getRouteByName( $name )
    {
        if( !$uri = $this->routeAlias[ $name ] ) {
            throw new \Exception("[{$name}] doesnt exist.");
        }

        return $this->getRoute( $uri );
    }

    public function addRoute( $method, $uri, $callback, $alias = null )
    {
        $this->routes[ $uri ] = $callback;

        if( $alias ) {
            $this->routeAlias[ $alias ] = $uri;
        }
    }
}
