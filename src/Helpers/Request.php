<?php

namespace Navel\Helpers;

class Request
{
    /**
     * The Request instance
     */
    public $request;

    /**
     * The request method
     */
    public $method;

    /**
     * The list of parameters from the request
     */
    public $parameters = [];

    /**
     * The constructor
     */
    public function __construct()
    {
        $this->capture();
    }

    /**
     * Capture the HTTP request
     *
     * @return self
     */
    public function capture()
    {
        $this->getMethod();
        $this->getParameters();

        return $this;
    }

    /**
     * Retrieve and return the parameters from the request
     *
     * @return array $this->parameters
     */
    public function parameters()
    {
        return $this->getParameters();
    }

    /**
     * Retrieve a specific parameter from the request
     *
     * @param  string $value
     * @return string $parameter
     */
    public function parameter( $value = null )
    {
        if ( is_null( $value ) ) {
            throw new \Exception('Parameter value is empty');
        }

        if ( !array_key_exists( $value, $this->parameters ) ) {
            return null;
        }

        return $this->parameters[$value];
    }

    /**
     * Retrieve the current header's method
     *
     * @return string $this->method
     */
    private function getMethod()
    {
        $this->method = "unknown";

        return $this->method;
    }

    /**
     * Retrieves and returns a list of parameters from the request
     *
     * @return array $this->parameters
     */
    private function getParameters()
    {
        $this->getHttpParameters();
        $this->getPostParameters();

        return $this->parameters;
    }

    public function getFirstParameter()
    {
        return $this->parameter(0);
    }

    private function getHttpParameters()
    {
        // Add to [$this->httpParameters] && [$this->parameters]
    }

    private function getPostParameters()
    {
        // Add to [$this->postParameters] && [$this->parameters]
    }
}
