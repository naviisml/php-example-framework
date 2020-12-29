<?php

namespace Navel\Foundation\Console;

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
    protected $bootstrappers = [
        \Navel\Foundation\Bootstrap\BootProviders::class,
    ];

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
        if( $this->app->booted ) {
            return;
        }

        $this->app->bootWith( $this->bootstrappers );

        $this->registerCommands();
    }

    /**
     * [registerCommands description]
     *
     * @return [type] [description]
     */
    protected function registerCommands()
    {
        foreach ([
            \Navel\Foundation\Console\Commands\ServeCommand::class,
            \Navel\Foundation\Console\Commands\MigrateCommand::class,
            \Navel\Foundation\Console\Commands\SeedCommand::class,
        ] as $key => $command ) {
            $this->registerCommand( $command );
        }
    }

    /**
     * [registerCommand description]
     *
     * @param  [type] $command [description]
     * @return [type]          [description]
     */
    public function registerCommand( $command )
    {
        $this->commands[] = $command;
    }

    /**
     * [getConsole description]
     *
     * @return [type] [description]
     */
    public function getConsole()
    {
        if( is_null( $this->console ) ) {
            $this->console = ( new Console( $this->app ) )->resolveCommands( $this->commands );
        }

        return $this->console;
    }
}
