<?php

namespace Navel\Framework\Console;

use Navel\Helpers\File;
use Navel\Helpers\Console\ArgvInput;
use Exception;

class Application
{
    /**
     * The application instance
     *
     * @var Navel\Foundation\Application
     */
    protected $app;

    /**
     * The console instance
     *
     * @var Navel\Foundation\Console\Application
     */
    protected $console;

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
    protected $lastOutput;

    /**
     * [__construct description]
     *
     * @param [type] $app [description]
     */
    public function __construct( \Navel\Foundation\Application $app )
    {
        $this->app = $app;
        $this->console = $this;
    }

    /**
     * [run description]
     *
     * @param  [type] $input [description]
     * @return [type]        [description]
     */
    public function run( $input = null )
    {
        $command = $this->getCommand(
            $input = $input ?: new ArgvInput
        );

        $this->call( $command );
    }

    /**
     * [call description]
     *
     * @param  [type] $command [description]
     * @return [type]          [description]
     */
    public function call( $command = null )
    {
        $command = $this->build(
            $input = $command
        );

        $output = $command->run();

        $this->lastOutput = $output;

        return $output;
    }

    /**
     * [parseCommand description]
     *
     * @param  [type] $input [description]
     * @return [type]        [description]
     */
    public function parseCommand( $input )
    {
        $command = $input->parameter(1);

        // Check if [$command] parameter is passed
        if( is_null( $input ) || !$command ) {
            throw new Exception( "[\$command] is null.", 404 );
        }

        return [ $command, $input->parameters() ?? null ];
    }

    /**
     * [resolveCommands description]
     *
     * @param  [type] $commands [description]
     * @return [type]           [description]
     */
    public function resolveCommands( $commands )
    {
        if ( !is_array( $commands ) ) {
            return $this->resolveCommand( $commands );
        }

        foreach ( $commands as $command ) {
            $this->resolveCommand( $command );
        }

        return $this;
    }

    /**
     * [resolveCommand description]
     *
     * @param  [type] $callback [description]
     * @return [type]           [description]
     */
    public function resolveCommand( $callback )
    {
        $command = $this->build( $callback );

        $this->add( $command, $callback );

        return $this;
    }

    /**
     * [add description]
     *
     * @param [type] $command  [description]
     * @param [type] $callback [description]
     */
    public function add( $command, $callback )
    {
        if( isset( $this->commands[ $command->name ] ) ) {
            throw new Exception("Command {$command->name} already exists.", 500);
        }

        $this->commands[ $command->name ] = $callback;

        if( $command->hidden === false ) {
            $this->commandList[ $command->name ] = $command->description;
        }
    }

    /**
     * [build description]
     *
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function build( $value )
    {
        return new $value($this);
    }

    /**
     * [getCommand description]
     *
     * @param  [type] $input [description]
     * @return [type]        [description]
     */
    public function getCommand( $input )
    {
        [$command, $parameters] = $this->parseCommand( $input );

        // Check if [$command] exists in [$this->commands]
        if( is_null( $callback = $this->commands[ $command ] ?? null ) ) {
            throw new Exception( "Command [{$command}] doesnt exist.", 404 );
        }

        return $callback;
    }
}
