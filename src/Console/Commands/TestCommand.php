<?php

namespace Navel\Console\Commands;

use Navel\Console\Commands\Command;

class TestCommand extends Command
{
    public $name = 'test';

    public $description = 'The first test command';

    public $help = 'No information provided.';

    public $hidden = true;

    public function run()
    {
        print_r('Run [test] command');
    }
}
