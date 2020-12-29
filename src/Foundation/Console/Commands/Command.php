<?php

namespace Navel\Foundation\Console\Commands;

use Com;

class Command
{
    /**
     * [protected description]
     *
     * @var [type]
     */
    protected $app;

    /**
     * [public description]
     *
     * @var [type]
     */
    public $name;

    /**
     * [public description]
     *
     * @var [type]
     */
    public $description;

    /**
     * [public description]
     *
     * @var [type]
     */
    public $help;

    /**
     * [public description]
     *
     * @var [type]
     */
    public $hidden;

    /**
     * [__construct description]
     *
     * @param [type] $app [description]
     */
    public function __construct( $app )
    {
        $this->app = $app;
    }


    /******************************************************************
     *                          Move to helpers                       *
     /*****************************************************************/


    public function question( $question, $answer = null, $hint = null )
    {
        while( true ) {
            $output = $this->ask( $question );

            // Display hint
            if( $hint && !( $output === $answer || in_array($output, $answer) ) ) {
                $this->prompt( $hint );
            }

            // Check when to break
            if( is_null( $answer ) || ( $output === $answer || in_array($output, $answer) ) ) {
                break;
            }
        }

        return $output;
    }

    public function ask( $question )
    {
        $output = $this->anticipate( $question, function( $input ) {
            return $input;
        });

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

        // Move to Helper (Console/Scripts)
        $reflection = new \ReflectionClass(\Navel\Foundation\Application::class);
        $hidden_input_file = dirname($reflection->getFileName(), 3) . '/scripts/hide_input_win.bat';

        $line = $hidden ? exec( PHP_OS === 'WINNT' || PHP_OS === 'WIN32' ? $hidden_input_file : 'read -s PW; echo $PW' ) : rtrim(fgets(STDIN), PHP_EOL);

        return $callback( $line );
    }

    public function prompt( $text )
    {
        echo "\033[31m{$text}\033[0m\n";
    }
}
