<?php

abstract class App_Controller extends Base_Controller{

    private $template = FALSE;
    private $data = [];

    private $allowed_http_methods = ['get', 'post'];

    function __construct(){
        parent::__construct();
        $this->init();
    }

    private function init_rest(){
        $this->request = new stdClass;
        $this->request->method = $this->detect_method();
    }

    private function detect_method(){
        $method = strtolower($this->input->server('REQUEST_METHOD'));
        if(in_array($method, $this->allowed_http_methods)){
            return $this->method = $method;
        }
    }

    public function _remap($method, $arguments){
        $controller_method = $method.'_'.$this->request->method;
        if(strtolower($this->request->method) == 'post'){
            $arguments[] = $this->input->post();
        }
        if(method_exists($this, $controller_method)){
            return call_user_func_array([$this, $controller_method], $arguments);
        }elseif(method_exists($this, $method)){
            return call_user_func_array([$this, $method], $arguments);
        }
        show_404();
    }

    private function init(){
        $this->output->enable_profiler($this->app->enable_profiler());
        $this->_template(config_item(TEMPLATE));
        $this->init_web_resources();
        $this->init_rest();
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