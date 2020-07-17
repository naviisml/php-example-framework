<?php

namespace Navel\Foundation;

class Application
{
    public $base_dir;

    public function __construct( $base_dir )
    {
        $this->setBasePath( $base_dir )

        // Load BaseProviders
    }

    public function make()
    {
        return $this;
    }

    public function handle()
    {
        return 'Hello World!';
    }

    private function setBasePath( $base_path )
    {
        $base_path = rtrim( $base_path );

        $this->base_dir = $base_path;
    }
}
