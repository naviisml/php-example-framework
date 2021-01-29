<?php

namespace Navel\Helpers;

class Request
{
    protected $parameters;

    public function parameter( $key )
    {
        return $parameters[ $key ] ?? null;
    }
}
