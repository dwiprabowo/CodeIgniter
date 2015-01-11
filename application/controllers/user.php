<?php

class User extends MY_Controller{

	protected $models = [
		'user',
		'administration'
	];

	protected $menu = [
		'new' => [
			'glyphicon' => 'new-window',
			'label' => 'Create New User',
			'action' => 'user/create',
			'active' => TRUE,
		],
		'all' => [
			'glyphicon' => 'list-alt',
			'label' => 'View all',
			'action' => 'user/all',
			'active' => TRUE,
		],
		'permission' => [
			'glyphicon' => 'lock',
			'label' => 'Manage Permission',
			'action' => 'user/permission',
			'active' => TRUE,
		],
		'profile' => [
			'glyphicon' => 'edit',
			'label' => 'Edit Profile',
			'action' => 'user/profile',
			'active' => TRUE,
		],
	];

	protected $required_permission = [
		'user'
	];

	function __construct(){
		parent::__construct();
		$this->_set_data('menu_title', 'User');
		$this->_set_data('menu_user', array_to_object($this->menu));
	}

	public function index(){}

	public function create_get(){}

	public function create_post($data){
		$result = $this->user_model->insert($data);
		if($result){
			$this->alert->success('New user created!');
			redirect($this->router->class);
		}
		redirect($this->path);
	}

	public function all_get(){
		$this->_set_data(
			'users'
			, $this->user_model->with(['login', 'administration'])->all()
		);
	}

	public function permission_get(){
		$this->_set_data(
			'users'
			, array_column(
				object_to_array(
					$this->user_model->with('login', 'administration')->all()
				)
				, 'username'
				, 'id'
			) 
		);
	}

	public function permission_post($data){
		if(!@$data['users']){
			$this->alert->error('Please select at least a User');
			redirect('user/permission');
		}
		$users = [];
		foreach($data['users'] as $user_id){
			$user = $this->user_model->get($user_id);
			$users[] = $user;
		}
		$administration_data = [];
		foreach($data as $k => $v){
			if(strpos($k,'data') !== false){
				$administration_data[] = str_replace('data_', '', $k);
			}
		}
		foreach($users as $user){
			$this->administration_model->update(
				$user->administration_id
				, ['data' => implode(',', $administration_data) ]
			);
		}
		$this->alert->success("You've granted a new permission for user");
		redirect('user');
	}

	public function profile_get(){}
}