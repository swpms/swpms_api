<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/user/login', function (Request $request, Response $response, array $args) {
    // Sample log message
    if($request->is('post')){
        $username = $request->getParam('username');
        $password = $request->getParam('password');
        if($dbUser->exists($username, $passowrd)){
            $payload = [
                'iss' => 'swpms.api',
                'expt' => strtitime('+2 hours'),
                'data' => [
                    'username' => $username,
                    'password' => $passowrd
                ]
            ];
            $token = JWT::encode($payload, $scretKey, $algorithm);
            return $response->withJson([
                'status' => 'OK',
                'token' => $token
            ]);
        }
    }
    // Render index view
    return $this->withJson(['status' => 'NG', 'token' => '']);
});