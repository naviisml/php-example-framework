<?php

namespace Navel\Framework\Bootstrap;

use Navel\Helpers\Facades\Facade;
use Navel\Foundation\Application;

class RegisterFacades
{
    /**
     * [boot description]
     *
     * @return [type] [description]
     */
    public function bootstrap( Application $app )
    {
        Facade::setFacadeInstance( $app );
    }
}
