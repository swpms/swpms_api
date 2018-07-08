<?php
// Application middleware
$app->add(new \App\Middleware\JwtAuthentication([
    'ignore' => [
        '/api/v1/token',
        '/user/login'
    ],
    'secret' => $container->security->salt
]));
