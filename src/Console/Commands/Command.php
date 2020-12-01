<?php

namespace Navel\Console\Commands;

class Command
{
    protected $booted = false;

    public $name;

    public $description;

    public $help;

    public $hidden;

    public function __construct()
    {
        //
    }
}
