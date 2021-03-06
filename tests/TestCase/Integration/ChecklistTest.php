<?php
namespace Tests\TestCase\Integration;

use Tests\Helper\IntegrationTestCase;
use Tests\Fixture\ChecklistFixture;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class UsersChecklistTestTest extends IntegrationTestCase
{
    public $fixtures = [
        ChecklistFixture::class
    ];

    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetList()
    {
        $response = $this->request('GET', '/api/v1/show/checklist', [
            'limit' => '2',
            'start' => '1',
            'kw'    => 'test item x'
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode($response->getBody());
        $this->assertEquals(3, $body->recordsTotal);
        $this->assertEquals(2, $body->recordsFiltered);
        $this->assertEquals(2, count($body->data));
    }
}
