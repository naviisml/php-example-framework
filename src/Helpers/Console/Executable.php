<?php

namespace Navel\Helpers\Console;

class Executable
{
    public function call( $input )
    {
        $command = $this->find( $input );
    }

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

    public function parseCommand( $command )
    {
        if( is_array( $command ) ) {
            $command = implode( " ", $command );
        }

        return $command;
    }
}
