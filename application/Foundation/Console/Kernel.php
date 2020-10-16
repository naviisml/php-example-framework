<?php

namespace Navel\Foundation\Console;

use Navel\Console\Application;
use Navel\Console\Commands;

class Kernel
{
    protected $app;

    protected $console;

    protected $commands;

    protected function bootstrap()
    {
        $this->app = $this;

        $this->commands[] = ['test'];
    }

    public function handle( $input, $output = null )
    {
        try {
            $this->bootstrap();

            // return exec('php -S navel.local:80');

            return $this->getApplication()->run( $input, $output );
        } catch( Exception $e ) {
            throw new \Exception( $e );
        }
    }

    private function getApplication()
    {
        if (is_null($this->console)) {
            return $this->console = (new Application( $this->app ))->resolveCommands( $this->commands );
        }

        return $this->console;
    }
}
