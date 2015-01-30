<?php

class Riwayat_belajar extends Online_cv{

    public function index(){
        $data = [
            'timer' => [
                'start' => 100,
                'padding_time' => 1500,
            ],
            'items' => [
                'university' => [
                    'period' => "2009 - 2013",
                    'content' => [
                        'icon' => 'icon-campus',
                        'title' => "STMIK AMIKOM",
                        'city' => 'Yogyakarta',
                    ],
                    'graduate' => [
                        "text" => "<h1><strong>3,81</strong><small>/4</small></h1>",
                    ],
                ],
                'course' => [
                    'period' => "2008 - 2009",
                    'content' => [
                        'icon' => 'icon-small-class-course',
                        'title' => "Intensive English Course (IEC)",
                        'city' => 'Magelang',
                    ],
                    'graduate' => [
                        "text" => "<h3><strong>Intermediate</strong> <small>class</small></h3>",
                    ],
                ],
                'highschool' => [
                    'period' => "2005 - 2008",
                    'content' => [
                        'icon' => 'icon-highschool',
                        'title' => "SMA Negeri 2",
                        'city' => 'Magelang',
                    ],
                    'graduate' => [
                        "key" => "result",
                        "text" => "<h1><strong>8,51</strong><small>/10</small></h1>",
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