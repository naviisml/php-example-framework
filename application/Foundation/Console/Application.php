<?php

namespace Navel\Foundation\Console;

use Navel\Console\Commands;
use Navel\Container\Container;
use Navel\Helpers\Console\ArgvInput;

class Application
{
    private $app;

    public function __construct( $app )
    {
        $this->app = $app;
    }

    /**
     * Run the application
     *
     * @param  object $input Request
     * @return
     */
    public function run( $input )
    {
        $input = $this->parseArgvInput();

        if($input->status === false) {
            throw new \Exception($input->message, $input->code);
        }

        // Find [$input->command] in Navel\Console\Commands [$aliases]
        // Return the command function
        print_r($input);
    }

    /**
     * Parse argv input
     *
     * @return array
     */
    public function parseArgvInput()
    {
        $parameters = ArgvInput::getParameters();

        // No command input
        if( is_null( $parameters ) || !$command = $parameters[1] ) {
            return (object) array("status" => false, "code" => 404, "message" => "Command not found");
        }

        return (object) array("status" => true, "parameters" => $parameters, "command" => $command);
    }

    public function resolve()
    {
        return $this;
    }
}
