<?php

abstract class App_Controller extends Base_Controller{

    private $template = FALSE;
    private $data = [];

    function __construct(){
        parent::__construct();
        $this->init();
    }

    private function init(){
        $this->output->enable_profiler($this->app->enable_profiler());
        $this->_template(config_item(TEMPLATE));
        $this->init_web_resources();
        $this->data('view', $this->view());
    }

    private function init_web_resources(){
        $this->load->driver('session');
        $this->load->library('assets');
        $this->load->library('twbs', config_item(TWBS));
        $this->load->library('assets', config_item(JQUERY), 'jquery');
    }

    private function view(){
        $value = $this->router->directory;
        $value .= $this->router->class;
        $value .= DIRECTORY_SEPARATOR;
        $value .= $this->router->method;
        $value = strtolower($value);
        return $value;
    }

    public function _template($name = FALSE){
        if($name){
            $this->template = $name;
        }
        return $this->template;
    }
}