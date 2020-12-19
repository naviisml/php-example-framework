<?php

namespace Navel\Foundation\Http;

use Navel\Helpers\Route;
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
    protected $bootstrappers = [
        \Navel\Framework\Bootstrap\BootProvider::class,
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
    public function __construct( Application $app )
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
            $this->app->bootWith( $this->bootstrappers );
        }
    }

    private function sendRequestThroughRouter()
    {
        $this->bootstrap();

        // Send request to Router
        // Do something with [$this->middleware]

        Route::get("/test", function() {
            echo 'Test';
        });

        debug( $this->app->make('router')->getRoute('/test') );
    }
}
