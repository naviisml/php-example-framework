<?php

namespace Navel\Foundation\Console\Commands;

use Navel\Helpers\Console\Question;

class Command
{
    /**
     * [protected description]
     *
     * @var [type]
     */
    protected $app;

    /**
     * [public description]
     *
     * @var [type]
     */
    public $name;

    /**
     * [public description]
     *
     * @var [type]
     */
    public $description;

    /**
     * [public description]
     *
     * @var [type]
     */
    public $help;

    /**
     * [public description]
     *
     * @var [type]
     */
    public $hidden;

    /**
     * [__construct description]
     *
     * @param [type] $app [description]
     */
    public function __construct( $app )
    {
        $this->app = $app;
    }
}
