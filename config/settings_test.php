<?php
$config = require __DIR__ . './settings.php';
return [
    'settings' => array_merge($config['settings'], [
        "db"      => [
            'driver'   => 'sqlite',
            'database' => __DIR__ . '/../db/testing.sqlite',
            'prefix'   => '',
        ]
    ]),
];
