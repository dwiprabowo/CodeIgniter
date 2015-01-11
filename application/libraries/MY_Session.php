<?php

class MY_Session extends CI_Session{

    const LOGIN_KEYWORD = 'login';

    public function add_form_value($key, $value){
        $this->add_form('values', $key, $value);
    }

    public function add_form_error($key, $value){
        $this->add_form('errors', $key, $value);
    }

    public function add_form($section, $key, $value){
        $CI =& get_instance();
        $form_key = $CI->router->get_uri_base();
        $this->set_flashdata('form_key', $form_key);
        $flashdata_key = $this->flashdata_key.':new:form';
        $this->userdata[$flashdata_key][$form_key][$section][$key] = $value;
    }

    public function get_form_error($key){
        $result = $this->get_form('errors', $key);
        return $result;
    }

    public function get_form_value($key){
        $result = $this->get_form('values', $key);
        return $result;
    }

    public function get_form($section, $key){
        $CI =& get_instance();
        $form_key = $this->flashdata('form_key');
        $flashdata_key = $this->flashdata_key.':new:form';
        $result = @$this->flashdata('form')[$form_key][$section][$key];
        return $result;
    }

    public function set_login_data($id){
        $this->set_userdata(self::LOGIN_KEYWORD, $id);
    }

    public function get_login_data(){
        return $this->userdata(self::LOGIN_KEYWORD);
    }

    public function delete_login(){
        $this->unset_userdata(self::LOGIN_KEYWORD);
    }
}
