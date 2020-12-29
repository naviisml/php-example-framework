<?php

namespace Navel\Helpers\Console;

class Question
{
    protected $inputColors = [
        "default" => "0m",
        "red" => "31m",
    ];

    public function ask( $question, $answer = null, $hint = null )
    {
        while( true ) {
            $output = $this->anticipate( $question, function( $input ) {
                return $input;
            });

            if( $hint && !( $output === $answer || in_array($output, $answer) ) ) {
                $this->prompt( $hint );
            }

            if( is_null( $answer ) || ( $output === $answer || in_array($output, $answer) ) ) {
                break;
            }
        }

        return $output;
    }

    public function secret( $question )
    {
        $output = $this->anticipate( $question, function( $input ) {
            return $input;
        }, true);

        return $output;
    }

    public function anticipate( $text, $callback, $hidden = false )
    {
        $this->prompt( $text );

        $line = $hidden ? exec( PHP_OS === 'WINNT' || PHP_OS === 'WIN32' ? __DIR__ . '\hide_input_win.bat' : 'read -s PW; echo $PW' ) : rtrim(fgets(STDIN), PHP_EOL);

        return $callback( $line );
    }

    public function prompt( $text )
    {
        echo "\033[31m{$text}\033[0m\n";
    }
}
