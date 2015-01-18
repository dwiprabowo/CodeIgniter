<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <h1 class="font_serif title"><?=t($app->title())?></h1>
        <?=str_repeat('<br>', 2)?>
        <p class="lead">
            <?=t($app->description())?>
        </p>
        <div>
            <?=assets('ci.png', ['class' => 'framework_img'])?>
            <span class="glyphicon glyphicon-plus front_plus_sign"></span>
            <?=assets('twbs-bootstrap.png', ['class' => 'framework_img'])?>
        </div>
        <?=str_repeat('<br>', 2)?>
        <div>
            <a 
                href="https://github.com/dwiprabowo/CodeIgniter/tree/base"
                class="btn btn-primary btn-lg" 
            >
                Lihat kode di <strong><ins>Github</ins></strong>
            </a>
        </div>
    </div>
</div>
