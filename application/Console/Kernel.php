<?php

namespace Navel\Console;

use Navel\Foundation\Application;
use Navel\Helpers\Console\ArgvInput;

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

        } catch (Throwable $e) {

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

        // Send request to Router
    }
}
