<?php
namespace Api\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UserController extends ApiController{
    /**
     * get list users
     *
     * @param Psr\Http\Message\RequestInterface $req
     * @param Psr\Http\Message\ResponseInterface $res
     * @param array $args
     * @return Psr\Http\Message\ResponseInterface
     */
    public function list(RequestInterface $req, ResponseInterface $res, array $args){
        $users = $this->db->table('users')->get();
        return $res->withJson($users);
    }
}
