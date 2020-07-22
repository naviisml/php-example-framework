<?php

namespace Navel\Http;

class Kernel
{
    public function __construct($test)
    {
    }

    public function handle()
    {
        echo 'HTTP Kernel works';

        // $this->sendRequestToRouter()
    }
}
