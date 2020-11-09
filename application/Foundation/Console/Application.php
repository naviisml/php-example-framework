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

    protected $commands = [];

    protected $aliases = [];

    protected $lastOutput = [];

    public function __construct( $app )
    {
        $this->app = $app;

        $this->boot();
    }

    public function boot()
    {
        // Load the commands here (from config file: application/config/console.php -> [commands]) ($this->boot())
    }

    public function run( $input = null )
    {
        $command = $this->getCommand(
            $input = $input ?: new ArgvInput
        );

        $this->call( $command );
    }

    public function call( $command = null, $callback = null )
    {
        print_r("Execute [{$command}]");
        // Step 1: Call command [$command]
        // Step 2: Save the response in [$this->lastOutput]
        // Step 3: Call [$callback] after [$command]
        // Step 4: Return [$this->outputBuffer]
    }

    public function parseCommand( $input )
    {
        $command = $input->parameter(1);

        // Check if [$command] parameter is passed
        if( is_null( $input ) || !$command ) {
            throw new Exception( "[$command] is null.", 404 );
        }

        return [ $command, $input->parameters() ?? null ];
    }

    public function getCommand( $input )
    {
        [$command, $parameters] = $this->parseCommand( $input );

        // Check if [$command] exists in [$this->commands]
        if( !$this->commands[ $command ] ) {
            throw new Exception( "Command [{$command} doesnt exist.]", 404 );
        }

        return $command;
    }
}
