<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Description goes here ...">
        <meta name="author" content="dwi.juli.prabowo@gmail.com">
        <?=$this->assets->load('favicon.ico')?>
        <title><?=$application->name?></title>
        <?=$this->assets->thirdparty('bootstrap')?>
        <?=$this->assets->load('bootstrap.css', 'dist/css')?>
        <?=$this->assets->bulk($this->bootstrap->get_css())?>
        <?=$this->assets->thirdparty_inactivate()?>
        <?=$this->assets->load('aqsara.css', 'aqsara')?>
        <?=$this->assets->load('global.css', 'aqsara')?>
        <?=$this->assets->thirdparty('ajax.googleapis.com')?>
        <?=$this->assets->load('jquery.js', 'ajax/libs/jquery/1.11.1')?>
        <?=$this->assets->thirdparty('bootstrap')?>
        <?=$this->assets->load('bootstrap.js', 'dist/js')?>
        <?=$this->assets->load('docs.min.js', 'assets/js')?>
        <?=$this->assets->thirdparty('jquery-ui-1.11.2')?>
        <?=$this->assets->load('jquery-ui.js', '')?>
        <?=$this->assets->thirdparty('chosen')?>
        <?=$this->assets->load('chosen.min.css', '')?>
        <?=$this->assets->load('chosen.jquery.js', '')?>
    </head>
    <body>
        <?=$this->load->view('bootstrap/templates/navbar')?>
        <?=$this->load->view('bootstrap/templates/container/'.$container_type)?>
        <?=$this->load->view('alert/view')?>
    </body>
</html>
