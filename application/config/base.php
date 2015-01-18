<?php

$config[TEMPLATE] = 'bootstrap';

$config[TWBS] = [
    "root_path" => "vendor/twbs/bootstrap/",
    "dist" => "dist/",
    "helper" => "twbs",
];

$config[JQUERY] = [
    "root_path" => "vendor/components/",
    "dist" => "dist/",
    "helper" => "jquery",
];

$config['assets_img'] = ['png', 'jpeg', 'ico'];


/*
    Sample menu, change the content of menu
*/
$config['menu'] = [
        'about_app' => [
            'label' => 'Tentang',
            'action' => 'tentang',
            'active' => [
                'tentang'
            ],
        ],
        'documentations' => [
            'label' => 'Dokumentasi',
            'active' => [
                'dokumentasi'
            ],
            'menu' => [
                'basic' => [
                    'label' => 'Dasar Aplikasi',
                    'action' => 'dokumentasi/dasar_aplikasi',
                ],
                'database_migration' => [
                    'label' => 'Migrasi Database',
                    'action' => 'dokumentasi/migrasi_database',
                ],
                'generating_crud' => [
                    'label' => 'Pembuatan CRUD',
                    'action' => 'dokumentasi/pembuatan_crud',
                ],
            ]
        ],
    ];
