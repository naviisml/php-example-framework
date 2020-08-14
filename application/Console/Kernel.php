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

            $this->getCli()->run( $input );
        } catch( Exception $e ) {
            throw new \Exception( $e );
        }
    }

    protected function getCli()
    {
        if ( is_null( $this->cli ) ) {
            $this->cli = ( new \Navel\Foundation\Console\Application() )->resolve();
        }

        return $this->cli;
    }

    protected function bootstrap()
    {

    }
}
