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
        'view' => [
            'template_path' => __DIR__ . '/../templates/',
            'twig' => [
//                'cache' => '{キャッシュのパス}',
                'debug' => true,
                'auto_reload' => true,
            ],
            'extension' => [
                \Twig_Extension_Debug::class
            ]
        ],
        // DataBase(MySQL) settings
        'db' => [
            'host' => '127.0.0.1',
            'port' => '3306',
            'user' => 'root',
            'pass' => 'root',
            'dbname' => 'slim',
        ],
    ],
];
