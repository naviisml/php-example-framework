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

    /**
     * [__construct description]
     */
    public function __construct()
    {

    }
}
