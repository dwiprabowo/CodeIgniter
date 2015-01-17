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
        $this->template(config_item(TEMPLATE));
        $this->load->library('twbs', config_item(TWBS));
        $this->load->library('assets', config_item(JQUERY), 'jquery');
        $this->data(
            'view'
            , strtolower(
                $this->router->directory
                .$this->router->class
                .DIRECTORY_SEPARATOR
                .$this->router->method
            )
        );
    }

    public function template($name = FALSE){
        if($name){
            $this->template = $name;
        }
        return $this->template;
    }
}