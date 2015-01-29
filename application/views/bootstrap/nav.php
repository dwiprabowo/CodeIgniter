<nav class="navbar navbar-default styled navbar-fixed-top" id="navbar_styled">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="navbar-header">
                    <?php if($menu->items() !== FALSE AND !empty($menu->items())): ?>
                        <button 
                            type="button" 
                            class="navbar-toggle collapsed" 
                            data-toggle="collapse" 
                            data-target="#bs-example-navbar-collapse-1"
                        >
                            <span class="sr-only">Toggle navigation</span>
                            <?=str_repeat('<span class="icon-bar"></span>', 3)?>
                        </button>
                    <?php endif; ?>
                    <a class="navbar-brand font_bold" href="<?=site_url()?>">
                        <?=$app->title()?>
                    </a>
                </div>
                <?php if(isset($menu)): ?>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <?php if($menu->items() !== FALSE): ?>
                                <?php foreach($menu->items() as $k => $v): ?>
                                    <?php
                                        $have_menu = isset($v->items);
                                    ?>
                                    <li class="<?=$have_menu?'dropdown':''?> <?=is_active($v->active)?>">
                                        <a 
                                            href="<?=create_link($v->action)?>"
                                            <?php if($have_menu): ?>
                                                class="dropdown-toggle"
                                                data-toggle="dropdown"
                                                role="button"
                                                aria-expanded="false"
                                            <?php endif; ?>
                                        >
                                            <?=$v->label?>
                                            <?php if($have_menu): ?>
                                                 <span class="caret"></span>
                                            <?php endif; ?>
                                        </a>
                                        <?php if($have_menu): ?>
                                            <ul class="dropdown-menu" role="menu">
                                                <?php foreach($v->items as $_k => $_v): ?>
                                                    <li>
                                                        <a href="<?=create_link($_v->action)?>">
                                                            <?=$_v->label?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>