<?php

namespace Navel\Http;

use Navel\Foundation\Application;

class Kernel
{
    /**
     * The application instance
     *
     * @var Navel\Foundation\Application
     */
    protected $app;

    /**
     * The bootstrap classes for the application.
     *
     * @var array
     */
    protected $bootstrapper = [
        \Navel\Http\Providers\AppServiceProvider::class
    ];

    /**
     * The constructor
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle a incomming request
     *
     * @return [type] [description]
     */
    public function handle()
    {
        try {
            $response = $this->sendRequestThroughRouter();
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
            $this->app->bootWith( $this->bootstrapper );
        }
    }

    private function sendRequestThroughRouter()
    {
        $this->bootstrap();

        // print_r( $this->app->instance('router') );

        // Send request to Router
    }
}
