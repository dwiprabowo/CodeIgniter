<?php

abstract class App_Controller extends Base_Controller{

    private $template = FALSE;
    private $data = [];

    private $allowed_http_methods = ['get', 'post'];

    function __construct(){
        parent::__construct();
        $this->init();
        array_push($this->models, "base/menu");
        $this->load_models();
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
            $this->post = $this->input->post();
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
        $this->data('view', $this->_view());
    }

    public function _build(){
        $this->_build_alert();
    }

    private function init_web_resources(){
        $this->load->driver('session');
        $this->load->library('assets');
        $this->load->library('twbs', config_item(TWBS));
        $this->load->library('assets', config_item(JQUERY), 'jquery');
        $this->load->library('assets', config_item(FONTAWESOME), 'fontawesome');
        $this->load->library('assets', config_item(FONTELLO), 'fontello');
        $this->load->library('alert');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->helper('form');
    }

    private function _view(){
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

    private function _build_alert(){
        $alerts = [];
        if(@$this->session->flashdata('alert')){
            $alerts[] = $this->session->flashdata('alert');
        }
        if(@$this->alert->items){
            foreach($this->alert->items as $item){
                $alerts[] = $item;
            }
        }
        foreach($alerts as $k => $v){
            if($v){
                switch($alerts[$k]['type']){
                    case 'error':
                        $alerts[$k]['label'] = 'danger';
                    break;
                    case 'success':
                        $alerts[$k]['label'] = 'success';
                    break;
                }
            }
        }
        if($alerts){
            $this->data('alerts', $alerts);
        }
    }

}