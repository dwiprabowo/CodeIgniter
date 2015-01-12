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
			$user = $this->user_model->get($this->temp_model->login());
			$this->alert->success(
<<<EOD
Welcome!
<br>
You're logged in as <strong>$user->name</strong>
EOD
			);
			redirect('home');
		}
		redirect($this->controller);
	}
}