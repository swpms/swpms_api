<?php
namespace Api\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Firebase\JWT\JWT;

class UserController extends ApiController
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
        $users = $this->db->table('users')->get();
        return $res->withJson($users);
    }

    /**
     * get list users
     *
     * @param Psr\Http\Message\RequestInterface $req
     * @param Psr\Http\Message\ResponseInterface $res
     * @param array $args
     * @return Psr\Http\Message\ResponseInterface
     */
    public function login(RequestInterface $req, ResponseInterface $res, array $args){
        $username = $req->getParam('username');
        $password = $req->getParam('password');
        
        $user = $this->db->table('users')->where([
            'username' => $username,
            'password' => md5($password)
        ])->first();
        

        if ($user) {
            $payload = [
                'iss' => 'swpms.api',
                'expt' => strtotime('+2 hours'),
                'data' => [
                    'username' => $username,
                    'password' => $password
                ]
            ];
            $token = JWT::encode($payload, $this->secret);
            return $res->withJson([
                'status' => 'OK',
                'token' => $token
            ]);
        }
        return $res->withJson([
            'status' => 'NG',
            'token' => ''
        ]);
    }
}
