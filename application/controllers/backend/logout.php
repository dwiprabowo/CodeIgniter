<?php

class Logout extends MY_Controller{
    protected $models = 'temp';

    public function index(){
        $this->temp_model->login(TRUE);
        $this->alert->success("Successfully logging You out");
        redirect();
    }
}
