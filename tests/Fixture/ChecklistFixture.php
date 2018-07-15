<?php
namespace Tests\Fixture;

use Tests\Helper\Fixture\TestFixture;
use Illuminate\Database\Schema\Blueprint as Table;

class ChecklistFixture extends TestFixture
{
    /**
     * table = users
     */
    public $table = 'checklists';

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create():void
    {
        $this->schema()->create($this->table, function (Table $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->timestamp('created');
            $table->timestamp('modified');
        });
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function data():array
    {
        return [
            0 => [
                'id'            => '1',
                'title'         => 'Item s1',
                'description'   => 'test item s1',
                'created'       => strtotime('-2 days'),
                'modified'      => strtotime('-1 hours')
            ],
            1 => [
                'id'            => '2',
                'title'         => 'Item s2',
                'description'   => 'test item x s2',
                'created'       => strtotime('-3 days'),
                'modified'      => strtotime('-2 hours')
            ],
            2 => [
                'id'            => '3',
                'title'         => 'Item s3',
                'description'   => 'test item x s3',
                'created'       => strtotime('-4 days'),
                'modified'      => strtotime('-2 hours')
            ]
        ];
    }
}
