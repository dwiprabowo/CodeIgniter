<?php
class Login_Model extends MY_Model{
    
    protected $plural_name = 'logins';
    protected $singular_name = 'login';

    protected $belongs_to = [
        'user'
    ];
    
    protected $form = [
        'items' => [
            'default' => [
                'title' => 'Please sign in',
                'fields' => [
                    [
                        'name' => 'username',
                        'label' => 'Username',
                        'rules' => 'required',
                    ],
                    [
                        'name' => 'password',
                        'label' => 'Password',
                        'type' => 'password',
                        'rules' => 'required',
                    ],
                ],
                'submit' => 'Log in',
            ]
        ]
    ];

    protected $before_create = ['encrypt_password'];
    protected $before_update = ['encrypt_password'];

    function encrypt_password($data){
        if(@$data['password']){
            $data['password'] = md5($data['password']);
        }
        return $data;
    }

    function check_login($data){
        if($this->validate($data)){
            $this->load->model('user_model');
	        $user = $this->user_model->get_by('username', $data['username']);
            $compare_password = ((@$user->login->password) === md5($data['password']));
            if($compare_password){
                return $user->id;
            }
			$this->alert->error('Invalid login information!');
            return FALSE;
        }
    }
}
