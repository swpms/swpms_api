<?php
// Routes
$app->get('/api/v1/users', '\Api\Controller\UserController:list')
    ->setName("user_list");

$app->post('/user/login', '\Api\Controller\UserController:login')
    ->setName("user_login");
