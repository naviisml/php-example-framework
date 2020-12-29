<?php

namespace Navel\Helpers;

class Request
{
    /**
     * [public description]
     *
     * @var [type]
     */
    public $headers;

    /**
     * [public description]
     *
     * @var [type]
     */
    public $request;

    /**
     * [public description]
     *
     * @var [type]
     */
    public $method;

    /**
     * [public description]
     *
     * @var [type]
     */
    public $parameters = [];

    /**
     * [__construct description]
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
        $this->parseRequest();

        $this->getHeaders();
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
     * [parseRequest description]
     * 
     * @return [type] [description]
     */
    protected function parseRequest()
    {
        foreach ( $_SERVER as $key => $value ) {
            $this->request[ $key ] = $value;
        }

        return $this->request;
    }

    /**
     * Retrieve the current header's method
     *
     * @return string $this->method
     */
    protected function getMethod()
    {
        $this->method = "unknown";

        return $this->method;
    }

    /**
     * [getHeaders description]
     *
     * @return [type] [description]
     */
    protected function getHeaders()
    {
        foreach ( $this->request as $key => $value ) {
            if (strpos($key, 'HTTP_') === 0) {
                $this->headers[$key] = $value;
            }
        }

        return $this->headers;
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

    /**
     * [getFirstParameter description]
     *
     * @return [type] [description]
     */
    public function getFirstParameter()
    {
        return $this->parameter(0);
    }

    /**
     * [getHttpParameters description]
     *
     * @return [type] [description]
     */
    protected function getHttpParameters()
    {
        // Add to [$this->httpParameters] && [$this->parameters]
    }

    /**
     * [getPostParameters description]
     *
     * @return [type] [description]
     */
    protected function getPostParameters()
    {
        // Add to [$this->postParameters] && [$this->parameters]
    }
}
