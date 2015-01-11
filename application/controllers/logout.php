<?php
class Logout extends MY_Controller{

	protected $models = [
		"temp"
	];

	function index(){
		$this->temp_model->login(TRUE);
		$this->alert->success("Logout successfully!");
		redirect();
	}
}