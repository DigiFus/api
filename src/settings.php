<?php
return [
    'settings' => [
        'displayErrorDetails' => true,

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
        
        // Configuración de mi APP
        'app_token_name'   => 'TOKEN-DIGIFUS',
        'connectionString' => [
            'dns'  => 'mysql:host=puffalexa.com;dbname=puffalex_digifus;charset=utf8',
            'user' => 'puffalex_root',
            'pass' => '1qazxsw2*'
        ]
    ],
];
