<?php
namespace Api\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ChecklistController extends ApiController
{
    /**
     * get list users
     *
     * @param Psr\Http\Message\RequestInterface $req
     * @param Psr\Http\Message\ResponseInterface $res
     * @param array $args
     * @return Psr\Http\Message\ResponseInterface
     */
    public function list(RequestInterface $req, ResponseInterface $res, array $args)
    {
        $start    = $req->getParam('start', 1);
        $limit    = $req->getParam('limit', 50);
        $order    = $req->getParam('order', 'created');
        $dir      = $req->getParam('dir', 'desc');
        $keyword  = $req->getParam('kw', null);

        // create default query
        $totalQuery = $this->db->table('checklists');
        $filterQuery = clone $totalQuery;

        // for search
        if($keyword){
            $filterQuery->orWhere('title', 'LIKE', "%{$keyword}%")
                ->orWhere('description', 'LIKE', "%{$keyword}%");
        }

        $filterQuery->offset($start - 1)
            ->limit($limit)
            ->orderBy($order, $dir);

        return $res->withJson([
            'recordsTotal'      => $totalQuery->count(),
            'recordsFiltered'   => $filterQuery->count(),
            'data'              => $filterQuery->get()
        ]);
    }
}
