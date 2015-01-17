<?php

abstract class App_Controller extends Base_Controller{

    private $template = FALSE;
    private $data = [];

    function __construct(){
        parent::__construct();
        $this->init();
    }

    private function init(){
        $this->template(config_item(TEMPLATE));
        $this->load->library('assets', config_item(TWBS), 'twbs');
        $this->load->library('assets', config_item(JQUERY), 'jquery');
    }

    public function template($name = FALSE){
        if($name){
            $this->template = $name;
        }
        return $this->template;
    }
}