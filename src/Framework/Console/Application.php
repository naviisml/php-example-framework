<?php

namespace Navel\Framework\Console;

use Navel\Helpers\Console\ArgvInput;
use Exception;

class Application
{
    /**
     * The application instance
     *
     * @var \Navel\Foundation\Application
     */
    protected $app;

    /**
     * [protected description]
     *
     * @var [type]
     */
    protected $commands;

    /**
     * [protected description]
     * 
     * @var [type]
     */
    protected $commandList;

    /**
     * The constructor function
     *
     * @param Application $app
     */
    public function __construct( \Navel\Foundation\Application $app )
    {
        $this->app = $app;
    }

    /**
     * [run description]
     *
     * @param  [type] $command [description]
     * @return [type]          [description]
     */
    public function run( $command = null )
    {
        $commandName = $this->getCommandName(
            $command ?: new ArgvInput
        );

        $this->call( $commandName );
    }

    /**
     * [call description]
     *
     * @param  [type] $commandName [description]
     * @return [type]              [description]
     */
    public function call( $commandName = null )
    {
        $command = $this->commands[$commandName] ?: null;

        if( is_null($command) ) {
            throw new Exception( "Command [{$commandName}] doesn't exist.", 404 );
        }

        $command->run( $this );

        return $command;
    }

    /**
     * [getCommandName description]
     *
     * @param  [type] $command [description]
     * @return [type]          [description]
     */
    public function getCommandName( $command )
    {
        $commandName = explode( ' ', trim( $command->name ) )[0];

        return $commandName ?: $command;
    }

    /**
     * [resolveCommands description]
     *
     * @param  [type] $commands [description]
     * @return [type]           [description]
     */
    public function resolveCommands( $commands )
    {
        if( is_array( $commands ) ) {
            foreach( $commands as $command ) {
                $this->resolve( $command );
            }
        }

        return $this;
    }

    /**
     * [resolve description]
     *
     * @param  [type] $command [description]
     * @return [type]          [description]
     */
    public function resolve( $command )
    {
        $this->add( $this->app->make( $command ) );
    }

    /**
     * [add description]
     *
     * @param [type] $command [description]
     */
    public function add( $command = null )
    {
        $commandName = $this->getCommandName(
            $command ?: new ArgvInput
        );

        $this->commands[ $commandName ] = $command;

        $this->commandList[ $commandName ] = [
            "name" => $commandName,
            "description" => $command->description,
            "help" => $command->help,
            "hidden" => $command->hidden,
        ];
    }
}
