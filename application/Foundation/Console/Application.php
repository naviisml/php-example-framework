<?php

namespace Navel\Foundation\Console;

class Application
{
    public function __construct()
    {

    }

    public function resolve( $input )
    {
        // Command line information
        var_dump($input);

        return $this;
    }

    public function run()
    {
        return 'Run the command';
    }
}
