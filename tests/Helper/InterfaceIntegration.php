<?php
namespace Tests\Helper;

use Slim\Http\Response;

interface InterfaceIntegration{
    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     * @return \Slim\Http\Response
     */
    public function request(string $requestMethod, string $requestUri, array $requestData = null, array $options = []):Response;
}