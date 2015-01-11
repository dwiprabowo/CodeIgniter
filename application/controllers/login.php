<?php

class Login extends MY_Controller{

	protected $models = [
		"login",
		"temp"
	];

	function __construct(){
		parent::__construct();
		if($this->temp_model->login()){
			redirect('home');
		}
	}

	public function index_get(){}

	public function index_post($data){
		$login = $this->login_model->check_login($data);
		if($login){
			$this->temp_model->login($login);
			redirect('home');
		}
		redirect($this->controller);
	}
}