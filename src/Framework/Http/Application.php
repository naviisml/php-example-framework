<?php

namespace Navel\Framework\Http;

use Exception;

class Application
{
    /**
     * The application instance
     *
     * @var \Navel\Foundation\Application
     */
    protected $app;

    /**
     * The constructor function
     *
     * @param Application $app
     */
    public function __construct( \Navel\Foundation\Application $app )
    {
        $this->app = $app;
    }
}
