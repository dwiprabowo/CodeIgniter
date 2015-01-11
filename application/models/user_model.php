<?php
class User_Model extends MY_Model{

    protected $plural_name = 'users';
    protected $singular_name = 'user';

    protected $before_create = ['insert_relations'];
    protected $after_create = ['add_relations'];

    protected $after_get = ['get_relations'];

    protected $models = [
        'login',
        'administration'
    ];

    protected $form = [
        'fields' => [
            [
                'name' => 'username',
                'label' => 'Username',
                'rules' => 'required|is_unique[users.username]',
            ],
            [
                'name' => 'password',
                'label' => 'Password',
                'type' => 'password',
                'rules' => 'required|min_length[6]',
            ],
        ],
        'submit' => 'Register'
    ];

    function insert_relations($data){
        $this->load->model('login_model');
        $this->load->model('administration_model');

        $login_id = $this->login_model->insert($data);
        if(!@$data['is_active']){
            $data['is_active'] = 1;
        }
        $administration_id = $this->administration_model->insert($data);
        $data['login_id'] = $login_id;
        $data['administration_id'] = $administration_id;

        return $data;
    }

    function add_relations($data){
        $login_id = $data['login_id'];
    }

    function get_relations($data){
        if(@$data->login_id){
            $data->login = $this->login_model->get($data->login_id);
        }
        return $data;
    }

    function is_active($id){
        $user = $this->get($id);
        $administration = $this->administration_model->get($user->administration_id);
        return $administration->is_active;
    }

    function activate($id){
        $user = $this->get($id);
        $result = $this->administration_model->update($user->administration_id, ['is_active' => 1]);
        return $result;
    }

    function get_admin_data($id){
        $user = $this->get($id);
        $result = $this->administration_model->get($user->administration_id);
        if($result){
            return explode(',', $result->data);
        }
        return FALSE;
    }

}
