<?php

namespace Navel\Foundation\Http\Providers;

use Navel\Foundation\Http\Providers\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Handle a incomming request
     *
     * @return [type] [description]
     */
    public function boot()
    {
        $this->registerCommands();
    }

    public function registerCommands()
    {
        //
    }
}
