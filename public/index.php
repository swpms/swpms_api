<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/constants.php';

session_start();

// Instantiate the app
$settings = require CONFIG_PATH . '/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require CONFIG_PATH . '/dependencies.php';

// Register middleware
require CONFIG_PATH . '/middleware.php';

// Register routes
require CONFIG_PATH . '/routes.php';

// Run app
$app->run();
