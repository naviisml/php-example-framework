<?php

namespace Navel\Http\Providers;

use Navel\Foundation\Http\Providers\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Handle a incomming request
     *
     * @return [type] [description]
     */
    public function handle()
    {
        print_r('Perfect testing practice here <----');
    }
}
