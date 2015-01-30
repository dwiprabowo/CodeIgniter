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
                padding-top: 90px;
            }
            .navbar-brand{
                font-family: "Ubuntu Bold", "Ubuntu Regular", sans-serif;
            }
            strong{
                font-family: "Ubuntu Bold", "Ubuntu Regular", sans-serif;
            }
            small{
                font-family: "Ubuntu Light", "Ubuntu Regular", sans-serif;
            }
            a{
                -webkit-transition: all .2s;
                transition: all .2s;
            }
            .popover{
                font-family: "Ubuntu Light", "Ubuntu Regular", sans-serif;
            }

            .background_fade_down{
                background: -moz-linear-gradient(top,  rgba(255,255,255,1) 0%, rgba(255,255,255,0.91) 84%, rgba(255,255,255,0) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(84%,rgba(255,255,255,0.91)), color-stop(100%,rgba(255,255,255,0))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,0.91) 84%,rgba(255,255,255,0) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,0.91) 84%,rgba(255,255,255,0) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,0.91) 84%,rgba(255,255,255,0) 100%); /* IE10+ */
                background: linear-gradient(to bottom,  rgba(255,255,255,1) 0%,rgba(255,255,255,0.91) 84%,rgba(255,255,255,0) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#00ffffff',GradientType=0 ); /* IE6-9 */
            }
            .background_fade_up{
                background: -moz-linear-gradient(top,  rgba(255,255,255,0) 0%, rgba(255,255,255,0.91) 16%, rgba(255,255,255,1) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0)), color-stop(16%,rgba(255,255,255,0.91)), color-stop(100%,rgba(255,255,255,1))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(255,255,255,0.91) 16%,rgba(255,255,255,1) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(255,255,255,0.91) 16%,rgba(255,255,255,1) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  rgba(255,255,255,0) 0%,rgba(255,255,255,0.91) 16%,rgba(255,255,255,1) 100%); /* IE10+ */
                background: linear-gradient(to bottom,  rgba(255,255,255,0) 0%,rgba(255,255,255,0.91) 16%,rgba(255,255,255,1) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#ffffff',GradientType=0 ); /* IE6-9 */
            }

            .navbar-default.styled{
                border: none;
                padding-top: 40px;
            }
            ul.nav.navbar-nav.navbar-right > li > a{
                border-bottom: 1px solid rgba(90, 90, 90, .1);
            }

            div#main-view{
                margin-bottom: 80px;
            }

            @media (min-width: 768px){
                ul.nav.navbar-nav.navbar-right > li > a{
                    border-bottom: none;
                }
            }
            @media (min-width: 992px){
            }
            @media (min-width: 1200px){
            }
        </style>
    </head>
    <body>
        <?php $this->load->view(twbs_nav()) ?>
        <div class="container">
            <div id="main-view">
                <?php $this->load->view($view) ?>
            </div>
        </div>
        <footer class="main position_fixed background_fade_up">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="footer_content">
                            <div class="text-center">
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
