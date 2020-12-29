<?php

namespace Navel\Helpers\Console;

class Executable
{
    /**
     * [call description]
     *
     * @param  [type] $input [description]
     * @return [type]        [description]
     */
    public function call( $input )
    {
        $command = $this->find( $input );
    }

    /**
     * [find description]
     *
     * @param  [type] $command [description]
     * @return [type]          [description]
     */
    public function find( $command )
    {
        $parsedCommand = $this->parseCommand(
            $command = $command
        );

        if( !( $php = $this->execute( $parsedCommand ) ) ) {
            throw new \Exception("The command doesnt exist!");
        }

        return $php;
    }

    /**
     * [execute description]
     *
     * @param  [type] $command [description]
     * @return [type]          [description]
     */
    public function execute( $command )
    {
        if ( $php = strtok( exec( $command ), \PHP_EOL ) ) {
            if ( !is_executable( $php ) ) {
                return false;
            }
        } else {
            return false;
        }

        return $php;
    }

    /**
     * [parseCommand description]
     * 
     * @param  [type] $command [description]
     * @return [type]          [description]
     */
    public function parseCommand( $command )
    {
        if( is_array( $command ) ) {
            $command = implode( " ", $command );
        }

        return $command;
    }
}
