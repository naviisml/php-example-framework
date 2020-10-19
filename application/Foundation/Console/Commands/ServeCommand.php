<?php

namespace Navel\Foundation\Console\Commands;

use Navel\Helpers\Console\PhpExecutable;
use Navel\Foundation\Console\Command;

class ServeCommand extends Command
{
    protected $command = "serve";

    protected $description = "Starts the development server on localhost:80";

    public function handle()
    {
        // PhpExecutable::find('php -S navel.local:80 public/index.php')
    }
}
