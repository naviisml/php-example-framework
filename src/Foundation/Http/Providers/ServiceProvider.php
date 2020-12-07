<?php

namespace Navel\Foundation\Http\Providers;

use Navel\Foundation\Application;

class ServiceProvider
{
    protected $app;

    /**
     * Handle a incomming request
     *
     * @return [type] [description]
     */
    public function __construct( Application $app )
    {
        $this->app = $app;

        // print_r( $app->instance('Navel\Console\Kernel') );
        $this->boot();
    }
}
