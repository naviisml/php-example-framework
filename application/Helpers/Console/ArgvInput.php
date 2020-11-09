<?php

namespace Navel\Helpers\Console;

use Navel\Helpers\Request;

class ArgvInput extends Request
{
    public function capture()
    {
        $this->getArgvar();

        parent::capture();
    }

    /**
     * Contains an array of all the arguments passed to the script when running from the command line.
     *
     * @return array $this->parameters
     */
    public function getArgvar()
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
                $this->parameters[$parameters[1]] = $parameters[2];
            } else {
                $this->parameters[$key] = $value;
            }
        }

        return $this->parameters;
    }
}
