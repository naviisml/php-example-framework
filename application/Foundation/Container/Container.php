<?php

namespace Navel\Foundation\Container;

class Container
{
    protected $instances;

    protected $aliases;

    public function instance( $key, $value )
    {
        $this->make( $key, $value );
    }

    public function make( $key, $value = null )
    {
        return $this->resolve( $key, $value );
    }

    protected function resolve( $key, $value = null )
    {
        // If the key already exists, we will return the current value
        if( isset( $this->instances[$key] ) ) {
            return $this->instances[$key];
        }

        // If the value is null, the key and the value will be binded
        // to be used at a later time
        if (!$value) {
            $value = $key;
        }

        // Check if its a function
        if ( $key === $value || $key instanceof Closure ) {
            $value = $this->build( $value );
        }

        $this->instances[$key] = $value;

        return $value;
    }

    public function build( $value )
    {
        return new $value($this);
    }
}
