<?php

namespace Navel\Console;

class Kernel
{
    public function __construct($test)
    {
    }

    public function handle()
    {
        echo 'Console Kernel works';

        // $this->sendRequestToRouter()
    }
}
