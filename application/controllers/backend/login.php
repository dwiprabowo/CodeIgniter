<?php

class Login extends MY_Controller{

    protected $models = [
        "temp",
    ];

    public function index_get(){
        if($this->temp_model->login()){
            redirect($this->directory.'dashboard');
        }
    }

    public function index_post($data){
        $validated = $this->email_model->validate($data);
        if(!$validated){
            redirect($this->directory);
        }
        $result = $this->email_model->check_login($data);
        if($result){
            $this->temp_model->login($result);
            $this->alert->success('Welcome!');
            redirect($this->directory.'dashboard');
        }
        $this->alert->error('Invalid login information');
        redirect($this->directory);
    }
}
