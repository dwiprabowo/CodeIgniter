<?php

class Home extends Aqsara_core{

    public $models = ['email'];

    public function index(){}

    public function index_post(){
        $result = $this->email->insert($this->post);
        if($result){
            alert_success(
                "Terima Kasih, Anda akan segera menerima kabar dari Kami"
            );
            redirect($this->router->class);
        }
        if(validation_errors()){
            ialert_error(validation_errors());
        }
    }
}