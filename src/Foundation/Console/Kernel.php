<?php

namespace Navel\Foundation\Console;

use Navel\Foundation\Application;
use Navel\Framework\Console\Application as Console;

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
        \Navel\Framework\Bootstrap\BootProvider::class,
    ];

    /**
     * The constructor
     */
    public function __construct( Application $app )
    {
        $this->app = $app;

        $this->resolveCoreCommands();
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

    /**
     * [registerCommand description]
     *
     * @param  [type] $class [description]
     * @return [type]        [description]
     */
    public function registerCommand( $command )
    {
        $this->getConsole()->resolveCommand( $command );
    }

    /**
     * [resolveCoreCommands description]
     *
     * @return [type] [description]
     */
    protected function resolveCoreCommands()
    {
        foreach ([
            \Navel\Foundation\Console\Commands\ServeCommand::class,
        ] as $key => $command) {
            $this->registerCommand( $command );
        }
    }

    /**
     * [getConsole description]
     *
     * @return [type] [description]
     */
    private function getConsole()
    {
        if( is_null( $this->console ) ) {
            $this->console = ( new Console( $this->app ) )->resolveCommands( $this->commands );
        }

        return $this->console;
    }
}
