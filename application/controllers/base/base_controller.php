<?php

abstract class Base_Controller extends CI_Controller{

    const MODEL_NAME_TEMPLATE = '%_model';

    protected $models = [];

    function __construct(){
        parent::__construct();
        $this->init();
    }

    private function init(){
        array_push($this->models, "base/app");
        $this->load_models();
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
        $base_name = $name;
        if(string_contain($name, "/")){
            $names = explode('/', $name);
            $base_name = end($names);
        }
        $model_name = str_replace('%', $name, self::MODEL_NAME_TEMPLATE);
        $this->load->model($model_name, $base_name);
        $this->data($base_name, $this->$base_name);
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