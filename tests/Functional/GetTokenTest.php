<?php
namespace Tests\Functional;

use Firebase\JWT\JWT;

class GetTokenTest extends BaseTestCase
{
    /**
     * use middleware
     */
    public $withMiddleware = false;

    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetHomepageWithoutName()
    {
        $response = $this->request('GET', '/api/v1/users', []);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('a', (string)$response->getBody());
    }
}