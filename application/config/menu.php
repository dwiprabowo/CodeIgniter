<?php

$config['default_item'] = [
    'label'     => 'Menu',
    'action'    => '#',
    'active'    => [],
];

$config['menu'] = [
    "sekolah" => [
        'label' => 'Sekolah',
        'action' => 'sekolah',
        'active' => ['sekolah'],
    ],
    "kerja" => [
        'label' => 'Pekerjaan',
        'action' => 'pekerjaan',
        'active' => ['pekerjaan'],
    ],
    "keterampilan" => [
        'label' => 'Keterampilan',
    ],
];
