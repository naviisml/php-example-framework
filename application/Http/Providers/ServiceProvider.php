<?php

namespace Navel\Http\Providers;

class ServiceProvider
{
    /**
     * Handle a incomming request
     *
     * @return [type] [description]
     */
    public function __construct()
    {
        $this->boot();
    }
}
