<?php

class Home extends MY_Controller{

	public function index(){
        $user = $this->user_model->get($this->temp_model->login());
	}	
}