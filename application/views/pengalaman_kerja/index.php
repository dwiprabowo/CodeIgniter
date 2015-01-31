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
                    'desc'      => <<<EOD
Menjadi bagian dari tim developer,
Bertanggung jawab terhadap <em>issues</em> yang ada,
Implementasi fitur yang dibutuhkan oleh produk.
EOD
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
                    'desc'      => <<<EOD
<em>Maintenance</em> dan mengembangkan sistem lama,
melakukan optimisasi yang diperlukan pada sistem
EOD
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
                    'desc'      => <<<EOD
Pertama kali membuat sistem berbasis web penuh menggunakan framework
backend dengan konsep mvc dan <em>mobile optimized</em> frontend framework.
EOD
                ],
                [
                    'job_title' => 'Programmer',
                    'level'     => 'Game Project',
                    'start'     => ['year' => 2013, 'month' => 7],
                    'end'       => ['year' => 2013, 'month' => 10],
                    'desc'      => <<<EOD
Membuat game berbasis <em>smartphone</em> Android.
Melakukan riset game engine. Menggunakan <b>Corona</b>
sebagai alat untuk pengembangan.
EOD
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
                    'desc'      => <<<EOD
Studio Game yang dibuat bersama teman-teman dari Amikom dan Gameloft.
Membuat game yang kebanyakan berbasis Android.
EOD
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
                    'desc'      => <<<EOD
Perusahaan paling besar yang pernah saya masuki.
Melakukan proses <em>porting</em> game ke beberapa device.
EOD
                ],
                [
                    'job_title' => 'Java Mobile Game Programmer',
                    'level'     => 'Senior',
                    'start'     => ['year' => 2012, 'month' => 1],
                    'end'       => ['year' => 2012, 'month' => 9],
                    'desc'      => <<<EOD
Memiliki pengalaman lebih, memiliki kewajiban meng-<em>handle</em>
Programmer baru (junior).
EOD
                ],
                [
                    'job_title' => 'Java Mobile Game Programmer',
                    'level'     => 'Supervisor',
                    'start'     => ['year' => 2012, 'month' => 10],
                    'end'       => ['year' => 2012, 'month' => 11],
                    'desc'      => <<<EOD
Berimbang antara teknikal dan manajemen. Memimpin <em>sub</em>-tim
dengan jumlah total 3 orang.
EOD
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
                    'level'     => 'Mata Kuliah - Konsep Sistem Informasi',
                    'start'     => ['year' => 2010, 'month' => 9],
                    'end'       => ['year' => 2011, 'month' => 2],
                    'desc'      => <<<EOD
Pengalaman bekerja formal pertama kali.
Membantu Dosen praktik, menjelaskan materi kepada praktikan.
EOD
                ],
                [
                    'job_title' => 'Asisten Praktikum',
                    'level'     => 'Mata Kuliah - Pemrograman Terstruktur',
                    'start'     => ['year' => 2011, 'month' => 3],
                    'end'       => ['year' => 2011, 'month' => 8],
                    'desc'      => <<<EOD
Mengisi materi perkuliahan pada saat dipersilakan oleh Dosen praktik.
Membantu proses penilaian praktikan pada mata kuliah tersebut.
EOD
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
            $result[] = $key."-trigger";
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

    $unique_classes = [];

    function unique_class($im_a, &$unique_classes){
        $result = md5(json_encode($im_a));
        if(in_array($result, $unique_classes)){
            return "uniqueclasses".array_search($result, $unique_classes);
        }else{
            $unique_classes[] = $result;
        }
        $key = array_search($result, $unique_classes);
        return "uniqueclasses".$key;
    }

?>

<style>
    .content_wrapper .month{
        position: relative;
        padding: 20px 0px;
        padding-left: 20px;
        cursor: pointer;
    }
    .content_wrapper .year{
        border-bottom: 1px solid #333;
    }
    #work{
        overflow-y: auto;
        position: fixed;
        max-width: 200px;
    }
    .company{
        display: none;
    }
    .company .image i.fa{
        font-size: 108px;
    }
    .content_wrapper .month.active{
        color: #ccc;
        cursor: default;
    }

    @media (min-width: 768px){
        #work{
            max-width: 400px;
        }
    }

    @media (min-width: 992px){
        #work{
            max-width: 600px;
        }
    }

    @media (min-width: 992px){
        #work{
            overflow: auto;
            max-width: 600px;
        }
    }

    @media (min-width: 1200px){
        #work{
            max-width: 700px;
        }
        .work #work *{
            font-size: 1.2em;
        }
        .work #work h3{
            font-size: 2.4em;
        }
        .work #work h3 small{
            font-size: .85em;
        }
        .work #work .company .image i.fa{
            font-size: 108px;
        }
    }
</style>

<div class="row content_wrapper">
    <div class="col-xs-8 work">
        <div id="work">
            <?php foreach($works as $k => $v): ?>
                <div class="company" id="company_<?=$v['key']?>">
                    <h3><?=$v['company']?> <small>@<?=$v['city']?></small></h3>
                    <div>
                        <strong class="job_title"></strong> 
                        <br>
                        (<span class="job_level"></span>)
                    </div>
                    <blockquote class="desc"></blockquote>
                </div>
            <?php endforeach ?>
            <div class="company" id="no_data">
                <h3>Tidak ada Data</h3>
                <div class="image">
                    <i class="fa fa-frown-o"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-4 time">
        <?php foreach($objects as $k => $v): ?>
            <div 
                id="month<?=$k?>"
                class="month <?=get_work_class($v->im_a, $works)?> <?=unique_class($v->im_a, $unique_classes)?>"
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
                var classes = $(this).attr('class').split(/\s+/);
                $(".month").removeClass('active');
                $("."+classes.join(".")).addClass('active');
                var ids = get_company_ids($(this));
                $(".company").hide();
                for(var i = 0;i < ids.length;i++){
                    $("#"+ids[i]).fadeIn();
                }
                if(data_string == "[]"){
                    $("#no_data").fadeIn();
                }
                for(var i = 0;i < data.length;i++){
                    $("#"+data[i].id).find('.job_title').html(data[i].job_title);
                    $("#"+data[i].id).find('.job_level').html(data[i].level);
                    $("#"+data[i].id).find('.desc').html(data[i].desc);
                }
                active = data_string;
            }
        });

        function get_company_ids(el){
            var result = [];
            var classes = el.attr('class').split(/\s+/);
            for(var i = 0;i < classes.length;i++){
                if(contain(classes[i], '-trigger')){
                    result.push('company_'+classes[i].replace('-trigger', ''));
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

        $("#work").css("max-height", ($(window).height() - 140)+"px");
        setTimeout(function(){
            $("#month<?=count($objects)-1?>").mouseover();
            window.scrollTo(0, $(".time").height());
        }, 1000);
    });
</script>