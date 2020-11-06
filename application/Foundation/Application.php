<?php

namespace Navel\Foundation;

use Navel\Foundation\Container\Container;

class Application extends Container
{
    /**
     * The framework's version
     *
     * @var string
     */
    public $version = "2.0.0";

    /**
     * The application's base directory
     *
     * @var string
     */
    public $base_dir;

    /**
     * Wether the application is booted or not.
     *
     * @var boolval
     */
    public $booted = false;

    /**
     * The applications service providers
     *
     * @var array
     */
    protected $serviceProviders;

    /**
     * The constructor function
     *
     * @param string $base_dir The applications base dir
     */
    public function __construct( $base_dir = null )
    {
        if ($base_dir) {
            $this->setBasePath( $base_dir );
        }

        $this->registerBaseBindings();
        $this->registerBaseServiceProviders();
    }

    public function bootWith( $bootstrappers )
    {
        // Add [$bootstrappers] to [$this->bootstrappers] array

        $this->boot();
    }

    /**
     * [boot description]
     *
     * @return [type] [description]
     */
    public function boot()
    {
        // Execute [$this->bootstrappers] one by one
        //
        $this->booted = true;
    }

    /**
     * [registerBaseBindings description]
     *
     * @return [type] [description]
     */
    private function registerBaseBindings()
    {
        $this->instance( 'app', $this );
        $this->instance( 'request', ( new \Navel\Helpers\Request )->capture() );
    }

    /**
     * [registerBaseServiceProviders description]
     *
     * @return [type] [description]
     */
    private function registerBaseServiceProviders()
    {
        $this->register( \Navel\Foundation\Routing\Router::class );
    }

    /**
     * [register description]
     *
     * @param  [type]  $provider [description]
     * @param  boolean $force    [description]
     * @return [type]            [description]
     */
    private function register( $provider, $force = false )
    {
        // If the provider is a string, we will resolve it
        if ( is_string( $provider ) ) {
            $provider = $this->resolveProvider( $provider );
        }

        // Check if the application has been booted before executing the Provider
        if( $this->isBooted() ) {
            $this->bootProvider( $provider );
        }
    }

    /**
     * [bootProvider description]
     *
     * @param  [type] $provider [description]
     * @return [type]           [description]
     */
    public function bootProvider( $provider )
    {
        return $provider;
    }

    /**
     * [resolveProvider description]
     *
     * @param  [type] $provider [description]
     * @return [type]           [description]
     */
    public function resolveProvider( $provider )
    {
        return new $provider( $this );
    }

    /**
     * [isBooted description]
     *
     * @return boolean [description]
     */
    public function isBooted()
    {
        return $this->booted ?? null;
    }

    /**
     * [setBasePath description]
     *
     * @param [type] $base_path [description]
     */
    private function setBasePath( $base_path )
    {
        $base_path = rtrim( $base_path );

        $this->base_dir = $base_path;
    }
}

if( !function_exists('app') ) {
    function app()
    {
        return Container::getInstance('app');
    }
}

if( !function_exists('request') ) {
    function request()
    {
        return Container::getInstance('request');
    }
}
