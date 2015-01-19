<?php

abstract class Base_Controller extends CI_Controller{

    const MODEL_NAME_TEMPLATE = '%_model';

    private $models = ["base/app"];

    function __construct(){
        parent::__construct();
        $this->init();
    }

    private function init(){
        $this->load_models();
        $this->data('app', $this->app);
    }

    private function load_models(){
        if($this->models === FALSE){
            return;
        }
        foreach ($this->models as $key => $value) {
            $this->load_model($value);
        }
    }

    private function load_model($name){
        $names = explode('/', $name);
        $base_name = end($names);
        $model_name = str_replace('%', $name, self::MODEL_NAME_TEMPLATE);
        $this->load->model($model_name, $base_name);
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