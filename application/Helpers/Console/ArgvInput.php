<?php

namespace Navel\Helpers\Console;

class ArgvInput
{
    public static $parameters = [];

    /**
     * Contains an array of all the arguments passed to the script when running from the command line.
     *
     * @return array $this->parameters
     */
    public static function getParameters()
    {
        $arguments = $_SERVER["argv"] ?? null;

        // Check if arguments exist
        if(!$arguments) {
            return;
        }

        // Add parameter to array
        foreach ( $arguments as $key => $value ) {
            $parametersExist = preg_match("/\-\-(\w+)\=(\w+)/i", $value, $parameters);

            if ( $parametersExist && $parameters[1] && $parameters[2] ) {
                self::$parameters[$parameters[1]] = $parameters[2];
            } else {
                self::$parameters[$key] = $value;
            }
        }

        return self::$parameters;
    }
}
