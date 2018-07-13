<?php
namespace Tests\Fixture;
use Tests\Helper\Fixture\TestFixture;
use Illuminate\Database\Schema\Blueprint as Table;

class RoleFixture extends TestFixture{
    /**
     * table = users
     */
    public $table = 'roles';

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create():void
    {
        $this->schema()->create($this->table, function(Table $table) {
            $table->increments('id');
            $table->string('role')->unique();
            $table->string('description');
        });
    }
    
    /**
     * [create description]
     * @return [type] [description]
     */
    public function data():array{
        return [
            0 => [
                'id'            => '1',
                'role'          => 'admin',
                'description'   => 'Role is Admin'
            ]
        ];
    }
}
