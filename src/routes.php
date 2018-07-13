<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/api/v1/users', function (Request $request, Response $response, array $args) {
    $users = $this->db->table('users')->get();
    return $response->withJson($users);
});
