<?php

namespace Navel\Helpers\Traits;

trait Console
{
    /**
     * [public description]
     *
     * @var [type]
     */
    public $input;

    /**
     * [public description]
     *
     * @var [type]
     */
    public $output;

    /**
     * [protected description]
     *
     * @var [type]
     */
    protected $defaultColor = "\033[0m";

    /**
     * [protected description]
     *
     * @var [type]
     */
    protected $outputColors = [
        "white" => "\033[0m",
        "red" => "\033[31m",
    ];

    /**
     * [question description]
     *
     * @param  [type] $question [description]
     * @param  [type] $answer   [description]
     * @param  [type] $hint     [description]
     * @return [type]           [description]
     */
    public function question( $question, $answer = null )
    {
        while( true ) {
            $output = $this->ask( $question );

            if( is_null( $answer ) || ( $output === $answer || in_array($output, $answer) ) ) {
                break;
            }
        }

        return $output;
    }

    /**
     * [ask description]
     *
     * @param  [type] $question [description]
     * @return [type]           [description]
     */
    public function ask( $question )
    {
        $output = $this->anticipate( $question, function( $input ) {
            return $input;
        });

        return $output;
    }

    /**
     * [secret description]
     *
     * @param  [type] $question [description]
     * @return [type]           [description]
     */
    public function secret( $question )
    {
        $output = $this->anticipate( $question, function( $input ) {
            return $input;
        }, true);

        return $output;
    }

    /**
     * [anticipate description]
     *
     * @param  [type] $text     [description]
     * @param  [type] $callback [description]
     * @return [type]           [description]
     */
    public function anticipate( $text, $callback, $hidden = false )
    {
        $this->prompt([$this->color('red'), $text]);

        $output = $this->output( $hidden );

        return $callback( $output );
    }

    /**
     * [output description]
     *
     * @param  boolean $hidden [description]
     * @return [type]          [description]
     */
    public function output( $hidden = false )
    {
        $reflection = new \ReflectionClass(\Navel\Foundation\Application::class);
        $baseDir = dirname($reflection->getFileName(), 3);

        if( $hidden ) {
            // Windows Machine
            if( PHP_OS_FAMILY === 'Windows' ) {
                $this->output = exec($baseDir . '/scripts/hide_input_win.bat');
            }

            // Linux Machine
            if( PHP_OS_FAMILY === 'Linux' ) {
                $this->output = exec('read -s PW; echo $PW');
            }
        } else {
            $this->output = rtrim(fgets(STDIN), PHP_EOL);
        }

        return $this->output;
    }

    /**
     * [prompt description]
     *
     * @param  [type] $text [description]
     * @return [type]       [description]
     */
    public function prompt( $text, $inline = false )
    {
        if( is_array( $text ) ) {
            $text = implode($text);
        }

        echo $text . $this->defaultColor . ($inline ? null : "\n");
    }

    /**
     * [color description]
     *
     * @param  [type] $color [description]
     * @return [type]        [description]
     */
    public function color( $color )
    {
        return $this->outputColors[ $color ] ?: $this->defaultColor;
    }
}
