<?php

namespace Navel\Console;

use Navel\Foundation\Console\Command;

class Kernel
{
    protected $cli;

    public function __construct()
    {

    }

    public function handle( $input )
    {
        try {
            $this->bootstrap();

            $this->getKernel()->run( $input );
        } catch( Exception $e ) {
            throw new \Exception( $e );
        }
    }

    protected function getKernel()
    {
        if ( is_null( $this->cli ) ) {
            $this->cli = $this->createKernel()->resolve();
        }

        return $this->cli;
    }

    protected function createKernel()
    {
        return new \Navel\Foundation\Console\Kernel();
    }

    protected function bootstrap()
    {

    }
}
