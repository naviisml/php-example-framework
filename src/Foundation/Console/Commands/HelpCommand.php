<?php

namespace Navel\Foundation\Console\Commands;

use Navel\Foundation\Console\Commands\Command;

class HelpCommand extends Command
{
    /**
     * [public description]
     *
     * @var [type]
     */
    public $name = 'help';

    /**
     * [public description]
     *
     * @var [type]
     */
    public $description = 'Help!';

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
        print_r('Default command: `help`');
    }
}
