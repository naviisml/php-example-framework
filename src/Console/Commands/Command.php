<?php

namespace Navel\Console\Commands;

class Command
{
    protected $app;

    public $name;

    public $description;

    public $help;

    public $hidden;

    public function __construct( $app )
    {
        $this->app = $app;
    }
}
