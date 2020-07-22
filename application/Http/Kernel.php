<?php

namespace Navel\Http;

class Kernel
{
    public function __construct()
    {
    }

    public function handle( $input )
    {
        try {
            $this->bootstrap();

            // $this->sendRequestToRouter()
        } catch( Exception $e ) {
            throw new \Exception( $e );
        }

    }

    protected function bootstrap()
    {

    }
}
