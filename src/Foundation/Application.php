<?php

namespace Navel\Foundation;

use Navel\Framework\Container\Container;

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
     * Wether the application has been booted (yet)
     *
     * @var boolval
     */
    public $hasBeenBootstrapped = false;

    /**
     * The applications boot array
     *
     * @var array
     */
    protected $bootstrappers = [];

    /**
     * The constructor function
     *
     * @param string $base_dir The applications base dir
     */
    public function __construct( $base_dir = null )
    {
        if ( $base_dir ) {
            $this->setBasePath( $base_dir );
        }

        $this->registerBaseBindings();
        $this->registerBaseServiceProviders();
        $this->registerCoreContainerAliases();
    }

    /**
     * [bootWith description]
     * @param  [type] $bootstrappers [description]
     * @return [type]                [description]
     */
    public function bootWith( $bootstrappers = null )
    {
        $this->hasBeenBootstrapped = true;

        if( is_array( $bootstrappers ) ) {
            $this->bootstrappers = array_merge( $this->bootstrappers, $bootstrappers );
        }

        $this->boot();
    }

    /**
     * [boot description]
     *
     * @return [type] [description]
     */
    public function boot()
    {
        if( $this->isBooted() ) {
            return;
        }

        // Bootstrap the application
        array_walk($this->bootstrappers, function ($p) {
            $this->resolveProvider($p);
        });

        $this->booted = true;
    }

    /**
     * [registerBaseBindings description]
     *
     * @return [type] [description]
     */
    private function registerBaseBindings()
    {
        static::setInstance($this);

        $this->instance( 'app', $this );

        $this->instance( Container::class, $this );
    }

    /**
     * [bindPathsInContainer description]
     *
     * @return [type] [description]
     */
    protected function bindPathsInContainer()
    {
        $this->instance('path', $this->path());
    }

    /**
     * [registerCoreContainerAliases description]
     *
     * @return [type] [description]
     */
    public function registerCoreContainerAliases()
    {
        foreach ([
            'router'                  => [\Navel\Framework\Routing\Router::class],
            'request'                  => [\Navel\Helpers\Request::class],
        ] as $key => $aliases) {
            foreach ($aliases as $alias) {
                $this->alias( $key, $alias );
            }
        }
    }

    /**
     * [registerBaseServiceProviders description]
     *
     * @return [type] [description]
     */
    private function registerBaseServiceProviders()
    {
        $this->register( \Navel\Foundation\Http\Providers\RoutingServiceProvider::class );
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

    /**
     * [path description]
     *
     * @return [type] [description]
     */
    public function path()
    {
        return $this->base_dir;
    }
}
