<?php
namespace Tests\Helper;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use PHPUnit\Framework\TestCase;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 */
abstract class IntegrationTestCase extends TestCase implements InterfaceIntegration
{
    public $fixtures = [];
    
    /**
     * Use middleware when running application?
     *
     * @var bool
     */
    protected $withMiddleware = true;

    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     * @param array|object|null $options
     * @return \Slim\Http\Response
     */
    public function request(string $requestMethod, string $requestUri, array $requestData = null, array $options = []):Response
    {
        // Create a mock environment for testing with
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ] + $options
        );

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        // Set up a response object
        $response = new Response();

        // Use the application settings
        $settings = require APP_PATH . '/settings_test.php';

        // Instantiate the application
        $app = new App($settings);

        // Set up dependencies
        require APP_PATH . '/dependencies.php';

        // Register middleware
        if ($this->withMiddleware) {
            require APP_PATH . '/middleware.php';
        }

        // Register routes
        require APP_PATH . '/routes.php';

        // Process the application
        $response = $app->process($request, $response);

        // Return the response
        return $response;
    }
}
