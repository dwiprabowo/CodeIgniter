<?php

class Riwayat_belajar extends Online_cv{

    public function index(){
        $data = [
            'timer' => [
                'start' => 100,
                'padding_time' => 1000,
                'padding_time_loading' => 12000,
            ],
            'items' => [
                'university' => [
                    'period' => "2009-2013",
                    'content' => [
                        'icon' => 'icon-campus',
                        'title' => "STMIK AMIKOM",
                        'city' => 'Yogyakarta',
                        'text' => <<<EOD
Mengambil Jurusan <b>Sistem Informasi</b>, dikarenakan lulusan IPS.
Tempat kerja formal pertama sebagai Asisten Laboratorium,
pada masa aktif kuliah.
EOD
,
                    ],
                    'graduate' => [
                        "text" => "<strong>3,81</strong><small>/4</small>",
                    ],
                ],
                'course' => [
                    'period' => "2008-2009",
                    'content' => [
                        'icon' => 'icon-small-class-course',
                        'title' => "Intensive English Course (IEC)",
                        'city' => 'Magelang',
                        'text' => <<<EOD
Belajar lebih dalam tentang struktur bahasa Inggris.
Sangat bermanfaat ketika belajar ilmu komputer, hampir
semua <b>dokumentasi</b> menggunakan <b>bahasa Inggris</b>.
EOD
,
                    ],
                    'graduate' => [
                        "text" => "<strong class=\"smaller\">Intermediate</strong>",
                    ],
                ],
                'highschool' => [
                    'period' => "2005-2008",
                    'content' => [
                        'icon' => 'icon-highschool',
                        'title' => "SMA Negeri 2",
                        'city' => 'Magelang',
                        'text' => <<<EOD
Masa-masa paling indah, kisah kasih di Sekolah.
Memiliki <b><em>personal computer</em> pertama</b> waktu duduk
dibangku kelas 2 SMA.
EOD
,
                    ],
                    'graduate' => [
                        "key" => "result",
                        "text" => "<strong>8,51</strong><small>/10</small>",
                    ],
                ],
            ]
        ];
        $schools = [];
        foreach($data['items'] as $k => $v){
            $schools[$k] = array_to_object($v);
        }
        $this->data('timer', array_to_object($data['timer']));
        $this->data('schools', $schools);
    }
}