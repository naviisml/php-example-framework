<?php

namespace Navel\Foundation\Container;

class Container
{
    public static $instances;

    public static function getInstance( $instance )
    {
        return self::$instances[ $instance ];
    }

    public function instance( $key, $value = null )
    {
        return $this->make( $key, $value );
    }

    public function make( $key, $value = null )
    {
        return $this->resolve( $key, $value );
    }

    protected function resolve( $key, $value = null )
    {
        // If the key already exists, we will return the current value
        if( isset( self::$instances[$key] ) ) {
            return self::$instances[$key];
        }

        // If the value is null, the key and the value will be binded
        // to be used at a later time
        if (!$value) {
            $value = $key;
        }

        // Check if its a function
        if ( $key === $value || $key instanceof Closure || is_string( $value ) ) {
            $value = $this->build( $value );
        }

        self::$instances[$key] = $value;

        return $value;
    }

    public function build( $value )
    {
        return new $value($this);
    }
}
