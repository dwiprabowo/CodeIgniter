<?=doctype('html5')?>
<html lang="<?=$app->lang()?>">
    <head>
        <meta charset="utf-8">
        <?=meta('X-UA-Compatible', $app->x_ua_compatible_equiv(), 'equiv');?>
        <?=meta('viewport', $app->viewport())?>
        <?=meta('description', t($app->description()))?>
        <?=meta('author', $app->author())?>
        <?=twbs('favicon.ico', 'docs/')?>
        <title><?=t($app->title())?></title>
        <?=twbs('bootstrap.css')?>
        <?=twbs('starter-template.css', 'docs/examples/starter-template/')?>
        <?=jquery('jquery.js', 'jquery/')?>
        <?=twbs('bootstrap.js')?>
        <?=assets('style.css')?>
    </head>
    <body>
        <?php $this->load->view(twbs_nav()) ?>
        <div class="container">
            <div class="starter-template">
                <?php $this->load->view($view) ?>
            </div>
        </div>
        <footer class="main position_fixed">
            <div class="row">
                <div class="col-sm-12">
                    <div class="footer_content">
                        <div class="float_right">
                            &copy;2014-<?=date('Y')?> <?=anchor(site_url(), t($app->title()))?>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
