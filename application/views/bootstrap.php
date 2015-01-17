<?=doctype('html5')?>
<html lang="<?=$app->lang()?>">
    <head>
        <meta charset="utf-8">
        <?=meta('X-UA-Compatible', $app->x_ua_compatible_equiv(), 'equiv');?>
        <?=meta('viewport', $app->viewport())?>
        <?=meta('description', $app->description())?>
        <?=meta('author', $app->author())?>
        <?=twbs('favicon.ico', 'docs/')?>
        <title><?=$app->title()?></title>
        <?=twbs('bootstrap.css')?>
        <?=twbs('starter-template.css', 'docs/examples/starter-template/')?>
        <?=jquery('jquery.js', 'jquery/')?>
        <?=twbs('bootstrap.js')?>
        <?=assets('style.css')?>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
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
                    <a class="navbar-brand" href="#"><?=$app->title()?></a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="starter-template">
                <h1>Bootstrap starter template</h1>
                <p class="lead">
                    Use this document as a way to quickly start any new <?=t('project')?>.<br> 
                    All you get is this text and a mostly barebones HTML document.
                </p>
            </div>
        </div>
        <footer class="main position_fixed">
            <div class="row">
                <div class="col-sm-12">
                    <div class="footer_content">
                        <div class="float_right">
                            &copy;2014-<?=date('Y')?> <?=$app->title()?>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
