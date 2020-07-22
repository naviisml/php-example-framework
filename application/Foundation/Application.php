<?php

namespace Navel\Foundation;

use Navel\Foundation\Container\Container;

class Application extends Container
{
    protected $version = "2.0.0";

    protected $base_dir;

    protected $booted = false;

    protected $serviceProviders;

    public function __construct( $base_dir = null )
    {
        if ($base_dir) {
            $this->setBasePath( $base_dir );
        }

        $this->boot();
        $this->registerBaseBindings();
        $this->registerBaseServiceProviders();
    }

    public function boot()
    {
        $this->booted = true;
    }

    private function registerBaseBindings()
    {
        $this->instance('app', $this);
    }

    private function registerBaseServiceProviders()
    {
        $this->register(\Navel\Foundation\Routing\Router::class);
    }

    private function register( $provider, $force = false )
    {
        // If the provider is a string, we will resolve it
        if (is_string($provider)) {
            $provider = $this->resolveProvider($provider);
        }

        // Check if the application has been booted before executing the Provider
        if($this->isBooted()) {
            $this->bootProvider( $provider );
        }
    }

    public function bootProvider( $provider )
    {
        return $provider;
    }

    public function resolveProvider( $provider )
    {
        return new $provider($this);
    }

    public function isBooted()
    {
        return $this->booted ?? null;
    }

    private function setBasePath( $base_path )
    {
        $base_path = rtrim( $base_path );

        $this->base_dir = $base_path;
    }
}
