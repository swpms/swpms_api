<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Security
        'security' => [
            'algorithm' => 'HS256',
            'salt'      => 'iBSygv04JGHMkSzbWTV3udvqBRNh0zmf'
        ],
        // Database connection settings
        "db"      => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'swpms_api',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => ''
        ],
        "db_test" => [
            'driver'   => 'sqlite',
            'database' => __DIR__ . '/tmp/testing.sqlite',
            'prefix'   => ''
        ]
    ],
];
