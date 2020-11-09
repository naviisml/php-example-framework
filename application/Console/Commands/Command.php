<?php

namespace Navel\Foundation\Console;

class Command
{
    public $name;

    public $description;

    public $help;

    public $hidden;

    public function __construct()
    {
        $this->boot();
    }
}
