<?php
// Routes
$app->get('/api/v1/users', '\Api\Controller\UserController:list')
    ->setName("user_list");

$app->get('/api/v1/users/get-list', '\Api\Controller\UserController:getList')
    ->setName("user_getlist");

$app->get('/api/v1/users/{id:\d+}', '\Api\Controller\UserController:get')
    ->setName("user_get");

$app->post('/api/v1/users/add', '\Api\Controller\UserController:add')
    ->setName("user_add");

$app->put('/api/v1/users/edit/{id:\d+}', '\Api\Controller\UserController:edit')
    ->setName("user_edit");

$app->delete('/api/v1/users/delete/{id:\d+}', '\Api\Controller\UserController:delete')
    ->setName("user_delete");

$app->post('/user/login', '\Api\Controller\UserController:login')
    ->setName("user_login");
