<?php

namespace Navel\Framework\Container;

use BoundMethod;
use ReflectionClass;
use ReflectionException;

class Container
{
    /**
     * [public description]
     *
     * @var [type]
     */
    public static $instance;

    /**
     * [protected description]
     *
     * @var [type]
     */
    protected $resolved;

    /**
     * [protected description]
     *
     * @var [type]
     */
    protected $aliases;

    /**
     * [protected description]
     *
     * @var [type]
     */
    protected $abstractAliases;

    /**
     * [protected description]
     *
     * @var [type]
     */
    protected $instances;

    /**
     * [getInstance description]
     *
     * @return [type] [description]
     */
    public static function getInstance()
    {
        if ( is_null( static::$instance ) ) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * [setInstance description]
     *
     * @param [type] $container [description]
     */
    public static function setInstance( $container = null )
    {
        return static::$instance = $container;
    }

    /**
     * [instance description]
     *
     * @param  [type] $key   [description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function instance( $key, $value = null )
    {
        return $this->make( $key, $value );
    }

    /**
     * [make description]
     *
     * @param  [type] $key   [description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function make( $key, $value = null )
    {
        return $this->resolve( $key, $value );
    }

    /**
     * [resolve description]
     *
     * @param  [type] $key   [description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    protected function resolve( $key, $value = null )
    {
        $key = $this->getAlias( $key );

        if( isset( $this->instances[$key] ) ) {
            return $this->instances[$key];
        }

        if (isset($this->bindings[$key])) {
            $value = $this->bindings[$key];
        }

        if (!$value) {
            $value = $key;
        }

        if ( is_string( $value ) ) {
            $value = $this->build( $value );
        }

        $this->instances[$key] = $value;
        $this->resolved[$key] = true;

        return $value;
    }

    /**
     * [getAlias description]
     *
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    protected function getAlias( $key )
    {
        return isset( $this->aliases[ $key ] ) ? $this->getAlias($this->aliases[$key]) : $key;
    }

    /**
     * [getAbstractAlias description]
     *
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    protected function getAbstractAlias( $key )
    {
        return isset( $this->abstractAliases[ $key ] ) ? $this->getAbstractAlias($this->abstractAliases[$key]) : $key;
    }

    /**
     * [alias description]
     *
     * @param  [type] $instance [description]
     * @param  [type] $alias    [description]
     * @return [type]           [description]
     */
    public function alias( $alias, $instance )
    {
        if ( $instance === $alias ) {
            throw new Exception("[{$instance}] is aliased to itself.");
        }

        $this->aliases[$alias] = $instance;

        $this->abstractAliases[$instance][] = $alias;
    }

    /**
     * [build description]
     *
     * @param  [type] $class [description]
     * @return [type]        [description]
     */
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
