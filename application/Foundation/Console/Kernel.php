<?php

namespace Navel\Foundation\Console;

use Navel\Console\Application;
use Navel\Console\Commands;

class Kernel
{
    protected $app;

    protected $console;

    public function __construct()
    {
        $this->app = $this;

        $this->getConsoleApplication();
    }

    // Run the console application
    public function handle( $input )
    {
        try {
            return $this->getConsoleApplication()->run( $input );
        } catch( Exception $e ) {
            throw new \Exception( $e );
        }
    }

    // Get the Console application
    private function getConsoleApplication()
    {
        if (is_null($this->console)) {
            return $this->console = (new Application( $this->app ))->resolve();
        }

        return $this->console;
    }
}
