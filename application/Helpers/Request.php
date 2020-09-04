<?php

namespace Navel\Helpers;

class Request
{
    protected static $instance;

    protected static $request;

    protected static $code;

    protected static $parameters;

    public function capture()
    {
        if( is_null( self::$instance ) ) {
            self::$instance = new self;
        }

        self::getConsoleArguments();

        return self::$instance;
    }

    public function parameters()
    {
        return self::$parameters;
    }

    protected function getConsoleArguments()
    {
        $arguments = $_SERVER['argv'] ?? null;

        if(!$arguments) {
            return;
        }

        // Check and remove the 'please' argument
        if (($key = array_search('please', $arguments)) !== false) {
            unset($arguments[$key]);
        }

        foreach ( $arguments as $key => $value ) {
            self::$parameters[] = $value;
        }

        return self::$parameters;
    }
}
