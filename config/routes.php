<?php
// Routes
$app->get('/api/v1/users', '\Api\Controller\UserController:list');

$app->get('/api/v1/show/checklist', '\Api\Controller\ChecklistController:list');
