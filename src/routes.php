<?php
use Slim\Http\Request;
use Slim\Http\Response;
use App\Lib\LogicFactory;

// Routes
$app->get('/api/v1/users', function (Request $request, Response $response, array $args) {
    // Render index view
    return $response->withJson(['a' => 1]);
});

// Routes
$app->get('/user/login', function (Request $request, Response $response, array $args) {
    // Render index view
    return $response->withJson(['a' => 1]);
});

// Routes
$app->get('/api/v1/token', function (Request $request, Response $response, array $args) {
    $time = time();
    $payload = [
        'iss'  => 'swpms.api',
        'iat ' => $time,
        'nbf'  => $time
    ];
    return $response->withJson(['token' => '']);
});
