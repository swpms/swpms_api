<?php
namespace App\Middleware;

use Firebase\JWT\JWT;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class JwtAuthentication{
    /**
     * @type array
     */
    protected $ignore = [];

    /**
     * @type string
     */
    protected $secret;

    /**
     * @type array
     */
    protected $algorithm;

    /**
     * @type string
     */
    protected $header;

    /**
     * construct
     */
    public function __construct(array $options = []){
        $this->ignore    = $options['ignore']??[];
        $this->secret    = $options['secret']??'';
        $this->algorithm = $options['algorithm']??['HS256'];
        $this->header    = $options['header']??'X-Token';

    }

    /**
     * middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, callable $next){
        if(in_array($request->getUri()->getPath(), $this->ignore)){
            return $next($request, $response);
        }

        $token = $request->getHeader($this->header);
        if(!empty($token)){
            $data = JWT::decode($token[0], $this->secret, $this->algorithm);
        }
        return $next($request, $response);
    }
}