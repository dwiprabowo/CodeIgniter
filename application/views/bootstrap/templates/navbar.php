<nav class="navbar <?=$navbar_type?> navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button 
                type="button" 
                class="navbar-toggle collapsed" 
                data-toggle="collapse" 
                data-target="#navbar" 
                aria-expanded="false" 
                aria-controls="navbar"
            >
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand application_title" href="<?=base_url()?>">
                <?=$application->name?>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
                <?php if(@$menus): ?>
                    <?php foreach($menus as $k => $v): ?>
                        <li class="
                            <?=@$v->menus?'dropdown':''?>
                            <?=@$v->active?'':'disabled'?>
                            <?=is_currently_active(@$v->active_in)?>
                            "
                        >
                            <a
                                href="<?=create_link(@$v->action)?>"
                            <?php if(@$v->menus): ?>
                                class="dropdown-toggle"
                                data-toggle="dropdown"
                                role="button"
                                aria-expanded="false"
                            <?php endif; ?>
                            >
                                <?=$v->label?>
                                <?php if(@$v->menus): ?>
                                    <span class="caret"></span>
                                <?php endif; ?>
                            </a>
                            <?php if(@$v->menus): ?>
                                <ul class="dropdown-menu" role="menu">
                                    <?php foreach($v->menus as $_k => $_v): ?>
                                        <li>
                                            <a href="<?=@$_v->action?site_url($_v->action):'#'?>">
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
    </div>
</nav>
