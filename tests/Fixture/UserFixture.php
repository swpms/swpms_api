<?php
namespace Tests\Fixture;

use Tests\Helper\Fixture\TestFixture;
use Illuminate\Database\Schema\Blueprint as Table;

class UserFixture extends TestFixture{
    /**
     * table = users
     */
    public $table = 'users';

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create():void
    {
        $this->schema()->create($this->table, function(Table $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email');
            $table->string('fullname')->nullable();
            $table->integer('role_id')->nullable();
        });
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function data():array{
        return [
            0 => [
                'id'        => '1',
                'username'  => 'vkiet',
                'password'  => '123',
                'email'     => 'vkiet@gmail.com',
                'fullname'  => 'Anh Kiet',
                'role_id'   => '1'
            ]
        ];
    }

}