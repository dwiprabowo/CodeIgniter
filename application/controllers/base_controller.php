<?php

abstract class Base_Controller extends CI_Controller{

    const MODEL_NAME_TEMPLATE = '%_model';

    private $models = [
        'app'
    ];

    function __construct(){
        parent::__construct();
        $this->load_models();
        $this->data('app', $this->app);
        if(!$this->session->userdata('language')){
            $this->session->set_userdata('language', $this->app->lang());
        }
    }

    public function _models(){
        return [];
    }

    private function load_models(){
        $this->models = array_replace_recursive(
            $this->models
            , $this->_models()
        );
        if($this->models === FALSE){
            return;
        }
        foreach ($this->models as $key => $value) {
            $this->load_model($value);
        }
    }

    private function load_model($name){
        $model_name = str_replace('%', $name, self::MODEL_NAME_TEMPLATE);
        $this->load->model($model_name, $name);
    }

    public function data($key = FALSE, $value = FALSE){
        if($key AND $value){
            $this->data[$key] = $value;
        }elseif($key){
            return $this->data[$key];
        }
        return $this->data;
    }
}