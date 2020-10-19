<?php

namespace Navel\Console;

use Navel\Console\Commands;

class Application
{
    protected $app;

    public function __construct( $app )
    {
        $this->app = $app;
    }

    public function run( $input )
    {
        $command = $this->findCommand( $input );

        if($command->status === false) {
            // throw new ConsoleException($command->message, $command->code);
        }

        // Find command based on $aliases in Commands

        print_r($command);
    }

    public function findCommand( $input )
    {
        $parameters = $input->parameters(); // Replace with ArgvVar class

        // No command found
        if( is_null( $parameters ) ) {
            return (object) array("status" => false, "code" => 404, "message" => "Command not found"); // Throw exception
        }

        return (object) array("status" => true, "name" => $parameters[0]); // Find and execute command
    }

    public function resolve()
    {
        return $this;
    }
}
