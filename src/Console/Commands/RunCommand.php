<?php

namespace Navel\Console\Commands;

use Navel\Helpers\Request;
use Navel\Helpers\Console\ArgvInput;
use Navel\Helpers\Console\Executable;
use Navel\Console\Commands\Command;

class RunCommand extends Command
{
    public $name = 'run';

    public $description = 'Start a php test-server.';

    public $help = 'No information provided.';

    public $hidden = false;

    protected $executable;

    public function run()
    {
        $argv = ArgvInput::test();

        $host = $argv->parameter('host') ?? 'localhost';
        $port = $argv->parameter('port') ?? '8080';

        $command = array(
            'php',
            '-S',
            "{$host}:{$port}",
            "-t",
            "public/"
        );

        $this->getExecutable()->find( $command );
    }

    private function getExecutable()
    {
        if( is_null( $this->executable ) ) {
            $this->executable = new Executable;
        }

        return $this->executable;
    }
}
