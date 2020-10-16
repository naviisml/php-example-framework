<?php

namespace Navel\Console;

use Navel\Foundation\Console\Command;

class Application
{
    protected $app;

    public function __construct( $app )
    {
        $this->app = $app;
    }

    public function run( $input )
    {
        $parameters = $input->parameters();

        if( is_null( $parameters ) ) {
            throw new \Exception('Please enter a command', 404);
        }

        print_r($parameters);
    }

    public function resolveCommands( $commands )
    {
        return $this;
    }
}
