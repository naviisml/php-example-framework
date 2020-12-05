<?php

namespace Navel\Foundation\Console;

use Navel\Helpers\File;
use Navel\Helpers\Console\ArgvInput;
use Exception;

class Application
{
    /**
     * The application instance
     *
     * @var Navel\Foundation\Application
     */
    protected $app;

    /**
     * The console instance
     *
     * @var Navel\Foundation\Console\Application
     */
    protected $console;

    protected $commands;

    protected $commandList;

    protected $aliases;

    protected $lastOutput;

    public function __construct( $app )
    {
        $this->app = $app;
        $this->console = $this;

        $this->boot();
    }

    public function boot()
    {
        $this->resolveDefaultCommands();
    }

    private function resolveDefaultCommands()
    {
        $this->resolveCommands([
            \Navel\Console\Commands\RunCommand::class
        ]);
    }

    public function run( $input = null )
    {
        $command = $this->getCommand(
            $input = $input ?: new ArgvInput
        );

        $this->call( $command );
    }

    public function call( $command = null )
    {
        $command = $this->build(
            $input = $command
        );

        $output = $command->run();

        $this->lastOutput = $output;

        return $output;
    }

    public function parseCommand( $input )
    {
        $command = $input->parameter(1);

        // Check if [$command] parameter is passed
        if( is_null( $input ) || !$command ) {
            throw new Exception( "[\$command] is null.", 404 );
        }

        return [ $command, $input->parameters() ?? null ];
    }

    public function resolveCommands( $commands )
    {
        if ( !is_array( $commands ) ) {
            return $this->resolveCommand( $commands );
        }

        foreach ( $commands as $command ) {
            $this->resolveCommand( $command );
        }

        return $this;
    }

    public function resolveCommand( $callback )
    {
        $command = $this->build( $callback );

        $this->add( $command->name, $callback );

        return $this;
    }

    public function add( $command, $callback )
    {
        // Get the command: $name, $description etc etc
        // Add to arrays
        $this->commands[ $command ] = $callback;
    }

    public function build( $value )
    {
        return new $value($this);
    }

    public function getCommand( $input )
    {
        [$command, $parameters] = $this->parseCommand( $input );

        // Check if [$command] exists in [$this->commands]
        if( is_null( $callback = $this->commands[ $command ] ?? null ) ) {
            throw new Exception( "Command [{$command}] doesnt exist.", 404 );
        }

        return $callback;
    }
}
