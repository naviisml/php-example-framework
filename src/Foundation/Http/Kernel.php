<?php

namespace Navel\Foundation\Http;

use Navel\Framework\Http\Application;

class Kernel
{
    /**
     * The application instance
     *
     * @var Navel\Foundation\Application
     */
    protected $app;

    /**
     * The Http application instance
     *
     * @var \Navel\Framework\Http\Application
     */
    protected $web;

    /**
     * The bootstrap classes for the application.
     *
     * @var array
     */
    protected $bootstrappers = [
        \Navel\Foundation\Bootstrap\BootProviders::class,
    ];

    /**
     * The applications middleware
     *
     * @var [type]
     */
    protected $middleware = [];

    /**
     * The constructor
     */
    public function __construct( \Navel\Foundation\Application $app )
    {
        $this->app = $app;
    }

    /**
     * Handle a incomming request
     *
     * @return [type] [description]
     */
    public function handle( $request )
    {
        try {
            $response = $this->sendRequestThroughRouter( $request );
        } catch (Exception $e) {
            $response = $e;
        } catch (Throwable $e) {
            $response = $e;
        }

        return $response;
    }

    /**
     * Bootstrap the application
     *
     * @return [type] [description]
     */
    public function bootstrap()
    {
        if( !$this->app->booted ) {
            $this->app->bootWith( $this->bootstrappers );
        }
    }

    protected function sendRequestThroughRouter( $request )
    {
        $this->bootstrap();

        debug( $this->getApplication() );
        // Send request to Router
        // Do something with [$this->middleware]
    }

    protected function getApplication()
    {
        if( is_null( $this->web ) ) {
            $this->web = ( new Application( $this->app ) );
        }

        return $this->web;
    }
}
