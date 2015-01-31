<?php
    $works = [
        [
            'key' => 'qareer',
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
            'key' => 'softwareseni',
            'company'   => 'SoftwareSeni',
            'city'      => 'Yogyakarta',
            'parts'     => [
                [
                    'job_title' => 'Ruby on Rails Programmer',
                    'level'     => 'junior',
                    'start'     => ['year' => 2013, 'month' => 11],
                    'end'       => ['year' => 2014, 'month' => 4],
                ],
            ],
        ],
        [
            'key' => 'oninyon',
            'company'   => 'Oninyon',
            'city'      => 'Yogyakarta',
            'parts'     => [
                [
                    'job_title' => 'Programmer',
                    'level'     => 'Web Project',
                    'start'     => ['year' => 2013, 'month' => 4],
                    'end'       => ['year' => 2013, 'month' => 6],
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
            'key' => 'cupcorn',
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
            'key' => 'gameloft',
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
            'key' => 'amikom',
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

    function im_a($datetime, $works){
        $result = [];
        foreach ($works as $k => $v) {
            foreach ($v['parts'] as $_k => $_v) {
                $date_start = new_datetime($_v['start']);
                $date_end = new_datetime($_v['end']);
                if($datetime >= $date_start AND $datetime <= $date_end){
                    $data = [
                        'company' => $k,
                        'part' => $_k
                    ];
                    $result[] = $data;
                }
            }
        }
        return $result;
    }

    function new_datetime($data){
        if($data === FALSE){
            return new DateTime();
        }
        return new DateTime(implode('-', $data));
    }

    function start($data){
        $result = new DateTime();
        foreach ($data as $k => $v) {
            foreach ($v['parts'] as $_k => $_v) {
                $date = new DateTime(implode('-', $_v['start']));
                if($date < $result){
                    $result = $date;
                }
            }
        }
        return $result;
    }

    $now = new DateTime();
    $start = start($works);
    $interval = $now->diff($start);
    $interval->total_months = $interval->format("%Y")*12 + $interval->format("%m");
    $objects = [];
    $counter = [
        'year' => $start->format('Y'),
        'month' => $start->format('n'),
    ];
    for($i = 0;$i <= $interval->total_months;$i++){
        $object = new stdClass;
        $object->datetime = new DateTime(implode('-', $counter));
        $object->im_a = im_a($object->datetime, $works);

        $counter['month'] += 1;
        if($counter['month'] > 12){
            $counter['year'] += 1;
            $counter['month'] = 1;
        }
        $objects[] = $object;
    }
    $objects = array_reverse($objects);

    function get_work_class($keys, $data){
        $result = [];
        foreach ($keys as $k => $v) {
            $key = $data[$v['company']]['key'];
            $result[] = $key."_trigger";
        }
        return implode(' ', $result);
    }

    function get_job($im_a, $works){
        $result = [];
        foreach ($im_a as $k => $v) {
            $part = $works[$v['company']]['parts'][$v['part']];
            $part['id'] = "company_".$works[$v['company']]['key'];
            $result[] = $part;
        }
        return json_encode($result);
    }

?>

<style>
    .content_wrapper .month{
        position: relative;
        padding: 20px 0px;
        padding-left: 20px;
    }
    #work{
        position: fixed;
        max-width: 200px;
    }
    .company{
        display: none;
    }
</style>

<div class="row content_wrapper">
    <div class="col-xs-8 work">
        <div id="work">
            <?php foreach($works as $k => $v): ?>
                <div class="company" id="company_<?=$v['key']?>">
                    <h2><?=$v['company']?> <small>@<?=$v['city']?></small></h2>
                    <div>
                        <strong class="job_title"></strong> 
                        <br>
                        (<span class="job_level"></span>)
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="col-xs-4 time">
        <?php foreach($objects as $k => $v): ?>
            <div 
                class="month <?=get_work_class($v->im_a, $works)?>"
                data-job='<?=get_job($v->im_a, $works)?>'
            >
                <small>
                    <?=
                        ($v->datetime->format('Ym')===$now->format('Ym'))
                        ?'Now'
                        :$v->datetime->format('F')
                    ?>
                </small>
            </div>
            <?php if($k === count($objects) - 1 OR $v->datetime->format('n') == 1): ?>
                <div class="year text-right">
                    <strong><?=$v->datetime->format('Y')?></strong>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</div>

<script>
    $(function(){
        var active = "";
        $(".month").mouseover(function(){
            var data = $(this).data('job');
            var data_string = JSON.stringify(data);
            if(data_string != active){
                var ids = get_company_ids($(this));
                $(".company").hide();
                for(var i = 0;i < ids.length;i++){
                    $("#"+ids[i]).show();
                }
                for(var i = 0;i < data.length;i++){
                    $("#"+data[i].id).find('.job_title').html(data[i].job_title);
                    $("#"+data[i].id).find('.job_level').html(data[i].level);
                }
                active = data_string;
            }
        });
        <?php foreach($works as $k => $v): ?>
        <?php endforeach ?>

        function get_company_ids(el){
            var result = [];
            var classes = el.attr('class').split(/\s+/);
            for(var i = 0;i < classes.length;i++){
                if(contain(classes[i], '_trigger')){
                    result.push('company_'+classes[i].replace('_trigger', ''));
                }
            }
            return result;
        }

        function contain(s, p){
            if(s.indexOf(p) > -1){
                return true;
            }
            return false;
        }
    });
</script>