<?php

namespace Navel\Foundation\Console;

use Navel\Foundation\Console\Command;

class TestCommand extends Command
{
    public $name = 'test';

    public $description = 'The first test command';

    public $help = 'No information provided.';

    public $hidden = true;

    public function boot()
    {
        print_r('Boot [test] command');
    }
}
