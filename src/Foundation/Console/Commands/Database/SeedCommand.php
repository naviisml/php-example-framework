<?php

namespace Navel\Foundation\Console\Commands\Database;

use Navel\Helpers\Request;
use Navel\Helpers\Console\ArgvInput;
use Navel\Helpers\Console\Executable;
use Navel\Foundation\Console\Commands\Command;

class SeedCommand extends Command
{
    /**
     * [public description]
     *
     * @var [type]
     */
    public $name = 'db:seed';

    /**
     * [public description]
     *
     * @var [type]
     */
    public $description = 'Database seeder';

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
     * [run description]
     *
     * @return [type] [description]
     */
    public function run()
    {
        print_r("Migrate database");
    }
}
