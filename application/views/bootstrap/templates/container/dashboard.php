<?php
    $dashboard_title = FALSE;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <?php foreach($container_menus as $k => $v): ?>
                    <?php
                        $is_active = FALSE;
                        if(@$v->active_in):
                            $is_active = in_array($this->router->get_uri_base(), object_to_array($v->active_in));
                        endif;
                    ?>
                    <li<?=$is_active?' class="active"':''?>>
                        <a href="<?=@$v->action?site_url($v->action):'#'?>">
                            <?=$v->label?>
                            <?php if($is_active): ?>
                                <span class="sr-only">(current)</span>
                                <?php
                                    $dashboard_title = $v->label;
                                ?>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Dashboard<?=$dashboard_title?' - '.$dashboard_title:''?></h1>
            <?=$this->load->view($view)?>
        </div>
    </div>
</div>
