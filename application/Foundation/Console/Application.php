<?php

namespace Navel\Foundation\Console;

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

    public function __construct( $app )
    {
        $this->app = $app;
    }

    public function run()
    {
        // Find command from Request

        $this->call('command');
    }

    public function call( $command = null, $callback = null )
    {
        if( is_null( $command ) ) {
            throw new Exception( '[$command] could not be found.', 404 );
        }

        if( is_array( $command ) ) {
            // Get command from array
        }

        // Call [$command]
        print_r('Execute [$command]');
    }
}
