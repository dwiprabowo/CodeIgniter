<?php
    $school_keys = array_keys($schools);
    $element_ids = array_map(function($v){return "#".$v;}, $school_keys);
?>

<style>
    .part_wrapper{
        padding-top: 30px;
    }
    .item_content_wrapper{
        display: table;
        width: 100%;
    }
    .item_content_wrapper .item{
        display: table-cell;
        vertical-align: top;
    }
    .item_content_wrapper .item.picture{
        width: 31%;
    }
    .item_content_wrapper .item.content{
        width: 69%;
    }
    .item_content_wrapper .item.picture i{
        position: relative;
        top: -8px;
        font-size: 64px;
    }
    .item_content_wrapper .item.content .image{
        position: relative;
        text-align: center;
    }
    .item_content_wrapper .item.content .image i{
        position: relative;
        top: -36px;
        font-size: 92px;
    }
    .item_content_wrapper .item.content .image .image_content{
        position: absolute;
        width: 100%;
        top: 6px;
    }
    .loading_separator{
        border-top-color: #DD4B39;
        width: 0;
    }
    i.icon-campus{
        color: #390A61;
    }
    i.icon-small-class-course{
        color: #E99511;
    }
    i.icon-highschool{
        color: #89ABC6;
    }
    .item_content_wrapper .item.content .image .image_content .smaller{
        font-size: .75em;
    }
    <?=implode(', ', $element_ids)?>{
        display: none;
    }

    @media (min-width: 768px){
        .item_content_wrapper .item.content .item_content_inner_wrapper{
            display: table;
            width: 100%;
        }
        .item_content_wrapper .item.content .item_content_inner_wrapper .nested_item{
            vertical-align: top;
            display: table-cell;
            width: 50%;
        }
        .item_content_wrapper .item.picture{
            width: 40%;
        }
        .item_content_wrapper .item.content{
            width: 60%;
        }
        .item_content_wrapper .item.picture i{
            top: -24px;
            font-size: 108px;
        }
        .item_content_wrapper .item.content .image i{
            top: 0px;
        }
        .item_content_wrapper .item.content .image .image_content{
            top: 40px;
        }
        .nested_item.content_info strong{
            font-size: 1.5em;
        }
        .nested_item.content_info small{
            font-size: 1.175em;
        }
        .item_content_wrapper .item.content .image .image_content .smaller{
            font-size: .85em;
        }
    }

    @media (min-width: 992px){
        .part_wrapper{
            padding-top: 60px;
        }
    }

    @media (min-width: 1200px){
        .part_wrapper{
            padding-top: 90px;
        }
        .item_content_wrapper .item.picture i{
            top: -24px;
            font-size: 150px;
        }
        .nested_item.content_info strong{
            font-size: 2.475em;
        }
        .nested_item.content_info small{
            font-size: 1.875em;
        }
        .item_content_wrapper .item.content .image i{
            font-size: 140px;
        }
        .item_content_wrapper .item.content .image .image_content{
            width: 100%;
            top: 56px;
        }
        .item_content_wrapper .item.content .image .image_content{
            font-size: 2em;
        }
        .item_content_wrapper .item.content .image .image_content .smaller{
            font-size: .65em;
        }
    }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="part_wrapper">
            <?php 
                $i = 0;
                foreach($schools as $k => $v): 
            ?>
                <?php if($i != 0): ?>
                    <hr class="loading_separator" id="hr_loading_<?=$i?>">
                <?php endif ?>
                <div class="item_wrapper" id="<?=$k?>">
                    <div class="item_content_wrapper">
                        <div class="item picture text-center">
                            <i class="<?=$v->content->icon?> text-info"></i>
                        </div>
                        <div class="item content">
                            <div class="item_content_inner_wrapper">
                                <div class="nested_item content_info">
                                    <strong>
                                        <?=$v->content->title?> 
                                    </strong>
                                    <small class="text-muted">
                                        <br>
                                        @<?=$v->content->city?>
                                        &nbsp;
                                        <i class="fa fa-clock-o"></i>
                                        <?=$v->period?>
                                        <blockquote>
                                            <p>
                                                <?=isset($v->content->text)?$v->content->text:""?>
                                            </p>
                                        </blockquote>
                                    </small>
                                </div>
                                <div class="nested_item image">
                                    <i class="icon-graduation-result-frame"></i>
                                    <div class="image_content">
                                        <?=$v->graduate->text?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                $i++;
                endforeach; 
            ?>
        </div>
    </div>
</div>
<script>
    $(function(){
        var time = <?=$timer->start?>;
        var padding_time = <?=$timer->padding_time?>;

        <?php for($i = count($schools) - 1;$i >= 0;$i--): ?>
            setTimeout(function(){
                $("<?=$element_ids[$i]?>").slideDown(padding_time);
            },time);
            time += padding_time;
            <?php if($i !== 0): ?>
                setTimeout(function(){
                    $("#hr_loading_<?=$i?>").animate(
                        {width: "100%"}
                        , <?=$timer->padding_time_loading?>);
                },time);
                time += <?=$timer->padding_time_loading?>;
            <?php endif ?>
        <?php endfor ?>
    })
</script>
