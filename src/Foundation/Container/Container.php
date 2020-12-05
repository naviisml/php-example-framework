<?php

namespace Navel\Foundation\Container;

use ReflectionClass;
use ReflectionException;

class Container
{
    public static $instance;

    protected $resolved;

    protected $aliases;

    protected $abstractAliases;

    protected $instances;

    public static function getInstance()
    {
        if ( is_null( static::$instance ) ) {
            static::$instance = new static;
        }

        return static::$instance;
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
        $key = $this->getAlias( $key );

        // If the key already exists, we will return the current value
        if( isset( $this->instances[$key] ) ) {
            return $this->instances[$key];
        }

        // If the value is null, the key and the value will be binded
        // to be used at a later time
        if (!$value) {
            $value = isset($this->bindings[ $key ]) ? $this->bindings[ $key ] : $key;
        }

        // Check if its a function
        if ( $key === $value || $key instanceof Closure || is_string( $value ) ) {
            $value = $this->build( $value );
        }

        $this->instances[$key] = $value;
        $this->resolved[$key] = true;

        return $value;
    }

    protected function getAlias( $key )
    {
        return isset( $this->aliases[ $key ]) ? $this->getAlias($this->aliases[$key]) : $key;
    }

    public function alias( $instance, $alias )
    {
        if ( $instance === $alias ) {
            throw new Exception("[{$instance}] is aliased to itself.");
        }

        $this->aliases[$alias] = $instance;

        $this->abstractAliases[$instance][] = $alias;
    }

    public function build( $class )
    {
        try {
            $reflector = new ReflectionClass( $class );
        } catch( ReflectionException $e ) {
            return;
        }

        if ( !$reflector->isInstantiable() ) {
            return $class;
        }

        return new $class( $this );
    }
}
