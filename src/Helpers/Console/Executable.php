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

        print_r($parsedCommand);
        print_r($command);

        // Check if the command exists and return command
    }

    public function parseCommand( $command )
    {
        if( is_array( $command ) ) {
            $command = implode( " ", $command );
        }

        return $command;
    }
}
