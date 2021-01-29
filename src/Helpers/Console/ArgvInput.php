<?php

namespace Navel\Helpers\Console;

use Navel\Helpers\Request;

class ArgvInput extends Request
{
    public $name;

    /**
     * [capture description]
     *
     * @return [type] [description]
     */
    public function capture()
    {
        $this->getArgvar();

        $this->name = $this->parameter(1);

        return $this;
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
            $parametersExist = preg_match("/\-\-(\w+)\=(.*)/i", $value, $parameters);

            if ( $parametersExist && $parameters[1] && $parameters[2] ) {
                $this->parameters[$parameters[1]] = $parameters[2];
            } else {
                $this->parameters[$key] = $value;
            }
        }

        return $this->parameters;
    }

    /**
     * Retrieve a specific parameter from the request
     *
     * @param  string $value
     * @return string $parameter
     */
    public function parameter( $value = null )
    {
        if ( is_null( $value ) ) {
            throw new \Exception('Parameter value is empty');
        }

        if ( !array_key_exists( $value, $this->parameters ) ) {
            return null;
        }

        return $this->parameters[$value];
    }
}
