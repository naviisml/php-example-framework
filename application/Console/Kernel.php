<?php

namespace Navel\Console;

use Navel\Foundation\Application;
use Navel\Foundation\Console\Application as ConsoleApplication;
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
     * [protected description]
     *
     * @var Navel\Foundation\Console\Application
     */
    protected $console;

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
            $this->bootstrap();

            $response = $this->getConsole()->run();
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

    private function getConsole()
    {
        if( is_null( $this->console ) ) {
            $this->console = new ConsoleApplication( $this->app );
        }

        return $this->console;
    }
}
