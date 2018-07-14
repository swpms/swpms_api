<?php
namespace Tests\TestCase\Integration;

use Tests\Helper\IntegrationTestCase;
use Tests\Fixture\UserFixture;
use Tests\Fixture\RoleFixture;

class UsersTest extends IntegrationTestCase
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
                'password'  => md5('123'),
                'email'     => 'vkiet@gmail.com',
                'fullname'  => 'Anh Kiet',
                'role_id'   => '1'
            ]
        ];

        $this->assertEquals($expected, json_decode($response->getBody(), true));
    }


    /**
     * test login
     */
    public function testLoginOK()
    {
        $response = $this->request('POST', '/user/login', [
            'username' => 'vkiet',
            'password' => '123'
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains("OK", (string)$response->getBody());
    }

     /**
     * test login
     */
    public function testLoginNG()
    {
        $response = $this->request('POST', '/user/login', [
            'username' => 'vkiet',
            'password' => '123v'
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains("NG", (string)$response->getBody());
    }
}
