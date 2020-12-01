<?php

namespace Navel\Console\Commands;

use Navel\Helpers\Console\Executable;
use Navel\Console\Commands\Command;

class ServeCommand extends Command
{
    public $name = 'serve';

    public $description = 'Start a php test-server.';

    public $help = 'No information provided.';

    public $hidden = false;

    public function run()
    {
        print_r( $this->description );
    }
}
