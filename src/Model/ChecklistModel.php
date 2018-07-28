<?php
namespace Api\Model;

use Illuminate\Database\Capsule\Manager;

class ChecklistModel
{
    protected $db;
    protected $table = 'checklists';

    public function __construct(Manager $db)
    {
        $this->db = $db;
    }

    /**
     *
     */
    public function pagination($settings = [])
    {
        extract($settings+ [
            'start' => 1,
            'limit' => 50,
            'order' => 'created',
            'dir'   => 'desc',
            'kw'    => null
        ]);

        // create default query
        $totalQuery = $this->db->table($this->table);
        $filterQuery = clone $totalQuery;
        // for search
        if ($kw) {
            $filterQuery
                ->orWhere('title', 'LIKE', "%{$kw}%")
                ->orWhere('description', 'LIKE', "%{$kw}%");
        }

        $filterQuery
            ->offset($start - 1)
            ->limit($limit)
            ->orderBy($order, $dir);

        return [
            'recordsTotal'    => $totalQuery->count(),
            'recordsFiltered' => $filterQuery->count(),
            'data'            => $filterQuery->get()
        ];
    }
}
