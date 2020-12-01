<?php

namespace Navel\Helpers\Console;

class Executable
{
    public function call( $input )
    {
        $command = $this->find( $input );
    }

    public function find()
    {
        // Check if the command exists and return command
    }
}
