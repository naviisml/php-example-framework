<?php

namespace Navel\Console\Commands;

use Navel\Foundation\Console\Command;

class TestCommand extends Command
{
    protected $command = "serve";

    protected $description = "Starts the development server on localhost:80.";

    public function handle()
    {

    }
}
