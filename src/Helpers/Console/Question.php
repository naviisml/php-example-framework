<?php

namespace Navel\Helpers\Console;

class Question
{
    protected $inputColors = [
        "default" => "0m",
        "red" => "31m",
    ];

    public function ask( $question )
    {
        $input = $this->anticipate( $question, function( $input ) {
            return $input;
        });

        return $input;
    }

    public function secret( $question, $hide = true )
    {

    }

    public function anticipate( $text, $callback )
    {
        // Move to helper
        $this->print( $text );

        $line = fgets( STDIN );

        return $callback( $line );
    }

    public function print( $text )
    {
        // Move to helper
        echo "\033[31m{$text}\033[0m\n";
    }
}
