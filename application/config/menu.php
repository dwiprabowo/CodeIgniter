<?php

$config['default_item'] = [
    'label'     => 'Menu',
    'action'    => '#',
    'active'    => [],
];

$config['menu'] = [
    "sekolah" => [
        'label' => 'Riwayat Belajar',
        'action' => 'riwayat_belajar',
        'active' => ['riwayat_belajar'],
    ],
    "kerja" => [
        'label' => 'Pengalaman Kerja',
        'action' => 'pengalaman_kerja',
        'active' => ['pengalaman_kerja'],
    ],
    "keterampilan" => [
        'label' => 'Keterampilan',
    ],
];
