<?php

namespace Navel\Console\Commands;

use Navel\Helpers\Request;
use Navel\Helpers\Console\Executable;
use Navel\Console\Commands\Command;

class ServeCommand extends Command
{
    public $name = 'serve';

    public $description = 'Start a php test-server.';

    public $help = 'No information provided.';

    public $hidden = false;

    protected $executable;

    public function run()
    {
        $command = array(
            'php',
            '-S',
            'localhost:8000',
            'public/index.php'
        );

        $this->getExecutable()->find($command);
    }

    private function getExecutable()
    {
        if( is_null( $this->executable ) ) {
            $this->executable = new Executable;
        }

        return $this->executable;
    }
}
