<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <?php if(isset($menu)): ?>
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
            <a class="navbar-brand font_serif font_bold" href="<?=site_url()?>">
                <?=$app->title()?>
            </a>
        </div>
        <?php if(isset($menu)): ?>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php foreach($menu->items() as $k => $v): ?>
                        <?php
                            $have_menu = isset($v->menu);
                        ?>
                        <li class="<?=$have_menu?'dropdown':''?> <?=is_active($v->active)?>">
                            <a 
                                href="<?=site_url($v->action)?>"
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
                            <?php if(isset($v->menu)): ?>
                                <ul class="dropdown-menu" role="menu">
                                    <?php foreach($v->menu as $_k => $_v): ?>
                                        <li><a href="<?=site_url($_v->action)?>"><?=$_v->label?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>