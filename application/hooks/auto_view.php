<?php

class AutoView{

    var $ci = null;

    function __construct(){
        $this->ci =& get_instance();
    }

    function run(){
        if($this->ci->input->is_cli_request()){
            return;
        }
        $this->ci->_build();
        $template = $this->ci->_template();
        $data = $this->ci->data();
        if($template){
            $this->ci->load->view($template, $data);
        }
    }
}