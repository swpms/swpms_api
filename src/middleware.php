<?php
// Application middleware
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "path"   => ["/api"],
    "ignore" => ["/api/token"],
    "header" => "X-Token",
    "secret" => $app->getContainer()
                    ->get('settings')
                    ->get('Security')['Salt']
]));
