<?php

namespace Navel\Foundation\Console\Commands;

use Navel\Helpers\Request;
use Navel\Helpers\Facades\ArgvInput;
use Navel\Helpers\Console\Executable;
use Navel\Foundation\Console\Commands\Command;

class ServeCommand extends Command
{
    /**
     * [public description]
     *
     * @var [type]
     */
    public $name = 'serve';

    /**
     * [public description]
     *
     * @var [type]
     */
    public $description = 'Start a php test-server.';

    /**
     * [public description]
     *
     * @var [type]
     */
    public $help = 'No information provided.';

    /**
     * [public description]
     *
     * @var [type]
     */
    public $hidden = false;

    /**
     * [protected description]
     *
     * @var [type]
     */
    protected $executable;

    /**
     * [run description]
     *
     * @return [type] [description]
     */
    public function run()
    {
        $argv = ArgvInput::capture();

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

    /**
     * [getExecutable description]
     *
     * @return [type] [description]
     */
    private function getExecutable()
    {
        if( is_null( $this->executable ) ) {
            $this->executable = new Executable;
        }

        return $this->executable;
    }
}
