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
    }

    /**
     * [register description]
     *
     * @return [type] [description]
     */
    public function register()
    {
        //
    }

    /**
     * [boot description]
     * 
     * @return [type] [description]
     */
    public function boot()
    {
        //
    }
}
