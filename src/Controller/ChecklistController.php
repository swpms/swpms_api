<?php
namespace Api\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Api\Model\ChecklistModel;

class ChecklistController extends ApiController
{
    /**
     * @var Api\Model\ChecklistModel
     */
    protected $model;

    /**
     * [init description].
     *
     * @return [type] [description]
     */
    public function initialize()
    {
        $this->model = new ChecklistModel($this->db);
    }

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
        $result = null;
        try{
            $start    = $req->getParam('start', 1);
            $limit    = $req->getParam('limit', 50);
            $order    = $req->getParam('order', 'created');
            $dir      = $req->getParam('dir', 'desc');
            $kw       = $req->getParam('kw', null);
            $result = $this->model->pagination([
                'limit' => $limit,
                'order' => $order,
                'dir' => $dir,
                'kw' => $kw
            ]);
        }catch(\Exception $e){
            return $res->withStatus(500)
                ->withJson([
                    'error' => [
                        'messsage' => 'Error system.',
                        'code'     => $e->getCode()
                    ]
                ]);
        }

        return $res->withJson($result);
    }
}
