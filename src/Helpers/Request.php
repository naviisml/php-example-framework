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
        $this->getMethod();
        $this->getHeaders();
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

    private function getHeaders()
    {
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $this->headers[$key] = $value;
            } else {
                $this->server[$key] = $value;
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
