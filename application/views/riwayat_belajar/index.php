<style>
    hr.loading_separator{
        border-top-color: #DA5043;
        width: 0%;
    }

    .part_content_wrapper{
        width: 100%;
    }
    .school_item_wrapper{
        display: table;
        width: 100%;
    }
    .school_item_wrapper > .item{
        display: table-cell;
        vertical-align: top;
    }
    .school_item_wrapper > .item.period{
        width: 20%;
    }
    .school_item_wrapper > .item.content{
        width: 80%;
    }
    .school_item_wrapper > .item.content > .item{
        display: inline-block;
    }
    .item_content_wrapper{
        display: inline-block;
        padding-left: 50px;
    }
    .school_item_wrapper div.illustration{
        max-width: 300px;
    }
    .school_item_wrapper div.illustration .image{
        margin: -120px;
        margin-top: -50px;
        font-size: 256px;
    }
    .school_item_wrapper div.graduate .image{
        position: relative;
        top: -80px;
        font-size: 240px;
    }
    .graduation_result_wrapper{
        position: relative;
    }
    .graduation_result_wrapper .result_text{
        position: absolute;
        width: 100%;
        text-align: center;
        top: 25%;
        left: 0;
    }
</style>

<div class="row outer_school_section_wrapper">
    <div class="col-lg-10 col-lg-offset-1 inner_school_section_wrapper">
        <!--
        <h1>
            <i class="icon-campus"></i>
            STMIK Amikom Yogyakarta <small>2009-2013</small>
        </h1>
        <h1>
            <i class="icon-small-class-course"></i>
            IEC (Intensive English Course) Magelang <small>2008-2009</small>
        </h1>
        -->
        <div class="part_wrapper text-center">
            <?php 
                $i = count($schools);
                foreach($schools as $k => $v): 
            ?>
                <hr class="loading_separator" id="hr_loading_<?=$i?>">
                <div class="part_content_wrapper" id="<?=$k?>">
                    <div class="school_item_wrapper text-center">
                        <div class="item period">
                            <h2 class="text-muted">
                                <ins><?=$v->period?></ins>
                            </h2>
                        </div>
                        <div class="item content">
                            <div class="item_content_wrapper">
                                <div class="item">
                                    <div id="the_<?=$k?>">
                                        <div class="title">
                                            <h2>
                                                <?=$v->content->title?> 
                                                <small><?=$v->content->city?></small>
                                            </h2>
                                        </div>
                                        <div class="image">
                                            <i class="<?=$v->content->icon?> text-info"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div 
                                        class="graduation_result_wrapper" 
                                        id="<?=$k?>_result"
                                    >
                                        <div class="image">
                                            <i class="icon-graduation-result-frame"></i>
                                        </div>
                                        <div class="result_text">
                                            <?=$v->graduate->text?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                $i--;
                endforeach; 
            ?>
        </div>
    </div>
</div>
