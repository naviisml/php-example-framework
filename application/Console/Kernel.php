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

            var_dump( $this->getCli( $input )->run() );
        } catch( Exception $e ) {
            throw new \Exception( $e );
        }
    }

    protected function getCli( $input )
    {
        if ( is_null( $this->cli ) ) {
            $this->cli = ( new \Navel\Foundation\Console\Application() )->resolve( $input );
        }

        return $this->cli;
    }

    protected function bootstrap()
    {

    }
}
