<?php

class Migration_Insert_Initial_Data_Admin extends CI_Migration{
    
    public $tablename = 'users';

    public function up(){
        $this->load->model('login_model');
        $this->load->model('administration_model');
        $this->load->model('user_model');
        $this->user_model->insert(
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'login_id' => 1,
                'administration_id' => 1,
                'password' => 'R4h4514',
                'data' => 'user,spk,stock,do,sales,stnk,bpkb',
                'is_active' => 1
            ]
        );
    }

    public function down(){
        $this->db->truncate($this->tablename);
    }
}
