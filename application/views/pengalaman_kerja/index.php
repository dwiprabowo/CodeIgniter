<?php
$start_data = [
    'year' => 2010,
    'month' => 9,
];
$now = new DateTime();
$start = new DateTime(implode('-', $start_data));
$interval = $now->diff($start);
$interval->total_months = $interval->format("%Y")*12 + $interval->format("%m");
$objects = [];
$counter = [
    'year' => $start->format('Y'),
    'month' => $start->format('n'),
];
for($i = 0;$i < $interval->total_months;$i++){
    $object = new DateTime(implode('-', $counter));
    $counter['month'] += 1;
    if($counter['month'] > 12){
        $counter['year'] += 1;
        $counter['month'] = 1;
    }
    $objects[] = $object;
}
$objects[] = $now;
$objects = array_reverse($objects);

$works = [
    [
        'company'   => 'Qareer',
        'city'      => 'Jakarta',
        'parts'     => [
            [
                'job_title' => 'Web Programmer',
                'level'     => 'Awesome PHP Developer',
                'start'     => ['year' => 2014, 'month' => 8],
                'end'       => FALSE,
            ],
        ],
    ],
    [
        'company'   => 'SoftwareSeni',
        'city'      => 'Yogyakarta',
        'parts'     => [
            [
                'job_title' => 'Ruby on Rails Programmer',
                'level'     => 'junior',
                'start'     => ['year' => 2013, 'month' => 11],
                'end'       => ['year' => 2014, 'month' => 5],
            ],
        ],
    ],
    [
        'company'   => 'Oninyon',
        'city'      => 'Yogyakarta',
        'parts'     => [
            [
                'job_title' => 'Programmer',
                'level'     => 'Web Project',
                'start'     => ['year' => 2013, 'month' => 4],
                'end'       => ['year' => 2013, 'month' => 7],
            ],
            [
                'job_title' => 'Programmer',
                'level'     => 'Game Project',
                'start'     => ['year' => 2013, 'month' => 7],
                'end'       => ['year' => 2013, 'month' => 10],
            ],
        ],
    ],
    [
        'company'   => 'CV Cupcorn Entertainment',
        'city'      => 'Yogyakarta',
        'parts'     => [
            [
                'job_title' => 'Android Mobile Game Programmer',
                'level'     => 'Lead',
                'start'     => ['year' => 2012, 'month' => 12],
                'end'       => ['year' => 2013, 'month' => 8],
            ],
        ],
    ],
    [
        'company'   => 'PT Gameloft Indonesia',
        'city'      => 'Yogyakarta',
        'parts'     => [
            [
                'job_title' => 'Java Mobile Game Programmer',
                'level'     => 'Junior',
                'start'     => ['year' => 2011, 'month' => 5],
                'end'       => ['year' => 2011, 'month' => 12],
            ],
            [
                'job_title' => 'Java Mobile Game Programmer',
                'level'     => 'Senior',
                'start'     => ['year' => 2012, 'month' => 1],
                'end'       => ['year' => 2012, 'month' => 9],
            ],
            [
                'job_title' => 'Java Mobile Game Programmer',
                'level'     => 'Supervisor',
                'start'     => ['year' => 2012, 'month' => 10],
                'end'       => ['year' => 2012, 'month' => 11],
            ]
        ],
    ],
    [
        'company'   => 'STMIK AMIKOM',
        'city'      => 'Yogyakarta',
        'parts'     => [
            [
                'job_title' => 'Asisten Praktikum',
                'level'     => 'Mata Kuliah -> Konsep Sistem Informasi',
                'start'     => ['year' => 2010, 'month' => 9],
                'end'       => ['year' => 2011, 'month' => 2],
            ],
            [
                'job_title' => 'Asisten Praktikum',
                'level'     => 'Mata Kuliah - Pemrograman Terstruktur',
                'start'     => ['year' => 2011, 'month' => 3],
                'end'       => ['year' => 2011, 'month' => 8],
            ]
        ]
    ],
];
?>

<style>
    .content_wrapper{
        padding-top: 50px;
    }
    .content_wrapper .year{
        padding: 50px;
    }
    .content_wrapper .month{
        padding: 20px;
    }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="content_wrapper">
            <?php foreach($objects as $k => $v): ?>
                <div class="month text-center">
                    <h3>
                        <?=($v===$now)?'Now':$v->format('F')?>
                    </h3>
                </div>
                <?php if($k === count($objects) - 1 OR $v->format('n') == 1): ?>
                    <div class="year text-center">
                        <h1><?=$v->format('Y')?></h1>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
</div>