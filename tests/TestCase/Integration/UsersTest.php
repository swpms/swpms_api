<?php
namespace Tests\TestCase\Integration;

use Tests\Helper\IntegrationTestCase;
use Tests\Fixture\UserFixture;
use Tests\Fixture\RoleFixture;

class HomepageTest extends IntegrationTestCase
{
    public $fixtures = [
        RoleFixture::class,
        UserFixture::class
    ];

    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetListUsers()
    {
        $response = $this->request('GET', '/api/v1/users');
        $this->assertEquals(200, $response->getStatusCode());
        $expected = [
            [
                'id'        => '1',
                'username'  => 'vkiet',
                'password'  => '123',
                'email'     => 'vkiet@gmail.com',
                'fullname'  => 'Anh Kiet',
                'role_id'   => '1'
            ]
        ];

        $this->assertEquals($expected, json_decode($response->getBody(), true));
    }
}