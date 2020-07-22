<?php

namespace Navel\Helpers;

class Request
{
    public function capture()
    {
        $arguments = self::getArguments();

        return $arguments;
    }

    protected function getArguments()
    {
        $arguments = $_SERVER['argv'];

        // Check and remove the 'please' argument
        if (($key = array_search('please', $arguments)) !== false) {
            unset($arguments[$key]);
        }

        return $arguments;
    }
}
