<?=doctype('html5')?>
<html lang="<?=$app->lang()?>">
    <head>
        <meta charset="utf-8">
        <?=meta('X-UA-Compatible', $app->x_ua_compatible_equiv(), 'equiv');?>
        <?=meta('viewport', $app->viewport())?>
        <?=meta('description', $app->description())?>
        <?=meta('author', $app->author())?>
        <?=assets('favicon.ico')?>
        <title><?=$app->title()?></title>
        <?=twbs('bootstrap.css')?>
        <?=twbs('starter-template.css', 'docs/examples/starter-template/')?>
        <?=jquery('jquery.js', 'jquery/')?>
        <?=twbs('bootstrap.js')?>
        <?=fontawesome('font-awesome.css')?>
        <?=assets('style.css')?>
        <style type="text/css">
            body{
                <?php if(twbs_body_color()): ?>
                    color: <?=twbs_body_color()?>;
                <?php endif; ?>
                <?php if(twbs_body_background_color()): ?>
                    background-color: <?=twbs_body_background_color()?>;
                <?php endif; ?>
            }
            nav.navbar{
                <?php if(twbs_nav_color()): ?>
                    background-color:  <?=twbs_nav_color()?>;
                <?php endif; ?>
            }
        </style>
    </head>
    <body>
        <?php $this->load->view(twbs_nav()) ?>
        <div class="container">
            <div class="starter-template">
                <div class="text-left">
                    <?php $this->load->view($view) ?>
                </div>
            </div>
        </div>
        <footer class="main position_fixed">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="footer_content">
                            <div class="float_right">
                                <strong>&copy;</strong>
                                2014 - <?=date('Y')?> 
                                <?=str_repeat('&nbsp;', 2)?>
                                <strong class="font_serif">
                                    <?=anchor(site_url(), $app->title())?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php $this->load->view('bootstrap/alert') ?>
    </body>
</html>
