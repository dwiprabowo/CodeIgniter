<?=doctype('html5')?>
<html lang="<?=$app->lang()?>">
    <head>
        <meta charset="utf-8">
        <?=meta('X-UA-Compatible', $app->x_ua_compatible_equiv(), 'equiv');?>
        <?=meta('viewport', $app->viewport())?>
        <?=meta('description', $app->description())?>
        <?=meta('author', $app->author())?>
        <?=twbs('favicon.ico', 'docs/')?>
        <title><?=$app->title(0)?></title>
        <?=twbs('bootstrap.css')?>
        <?=jquery('jquery.js', 'jquery/')?>
        <?=twbs('bootstrap.js')?>
        <?=fontawesome('font-awesome.css')?>
        <?=fontello('fontello.css')?>
        <?=assets('style.css')?>
        <style type="text/css">
            body{
                font-family: "Ubuntu Regular", sans-serif;
            }
            a.navbar-brand > span.title-adjust{
                position: relative;
                right: -5px;
            }
            a > span.title-adjust{
                position: relative;
                right: -3px;
            }
            footer{
                background: white;
            }

            .navbar-default.styled{
                background: none;
                border: none;
                padding-top: 3%;
            }
            nav#navbar_fixed{
                display: none;
            }
        </style>
    </head>
    <body>
        <?php $this->load->view('bootstrap/nav/styled') ?>
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
                                <strong>
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
