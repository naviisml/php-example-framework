<?php

namespace Navel\Helpers;

class Route
{
    /**
     * The router instance
     *
     * @var \Navel\Foundation\Router
     */
    protected $router;

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

    protected function addRoute( $method, $action, $alias )
    {

    }

    public function get()
    {
        $this->addRoute( $method, $action, $alias );
    }

    public function post()
    {
        $this->addRoute( $method, $action, $alias );
    }
}
