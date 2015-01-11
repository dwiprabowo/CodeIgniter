<?php

class Temp_Model extends CI_Model{
    public function login($id = FALSE){
        if($id === TRUE){
            return $this->session->delete_login();
        }elseif(!$id){
            return $this->session->get_login_data();
        }
        $this->session->set_login_data($id);
    }
}
