<?php

namespace Navel\Foundation\Console;

use Navel\Foundation\Console\Commands;

class Application extends Commands
{
    public function __construct()
    {

    }

    public function resolve()
    {
        return $this;
    }

    public function run( $request )
    {
        $parameters = $request->parameters();

        // Check if [$parameters] is_null
        if ( is_null( $request->parameters() ) ) {
            throw new \Exception('[$parameters] is empty.', 500);
        }


        var_dump( $request->parameters() );
    }
}
