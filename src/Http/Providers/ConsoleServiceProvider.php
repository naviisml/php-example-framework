<?php

namespace Navel\Http\Providers;

use Navel\Http\Providers\ServiceProvider;

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
