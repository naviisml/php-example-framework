<?php

namespace Navel\Console;

use Navel\Foundation\Application;
use Navel\Foundation\Console\Application as Console;

class Kernel
{
    /**
     * The application instance
     *
     * @var Navel\Foundation\Application
     */
    public $app;

    /**
     * [protected description]
     *
     * @var Navel\Foundation\Console\Application
     */
    public $console;

    /**
     * [protected description]
     *
     * @var array
     */
    protected $commands = [];

    /**
     * The bootstrap classes for the application.
     *
     * @var array
     */
    protected $bootstrapper = [
        \Navel\Http\Providers\AppServiceProvider::class,
        \Navel\Http\Providers\ConsoleServiceProvider::class
    ];

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
            $this->bootstrap();

            $response = $this->getConsole()->run();
        } catch ( Exception $e ) {
            $response = $e;
        } catch ( Throwable $e ) {
            $response = $e;
        }

        print_r( $this->console );

        return $response;
    }

    /**
     * Bootstrap the application
     *
     * @return [type] [description]
     */
    public function bootstrap()
    {
        if( ! $this->app->booted ) {
            $this->app->bootWith( $this->bootstrapper );
        }
    }

    public function registerCommand( $class )
    {
        $this->getConsole()->resolveCommand( $class );
    }

    private function getConsole()
    {
        if( is_null( $this->console ) ) {
            $this->console = ( new Console( $this->app ) )->resolveCommands( $this->commands );
        }

        return $this->console;
    }
}
