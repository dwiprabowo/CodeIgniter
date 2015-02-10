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
        if(method_exists($this->ci, '_build')){
            $this->ci->_build();
        }else{
            return;
        }
        $template = $this->ci->_template();
        $data = $this->ci->data();
        if($template){
            $this->ci->load->view($template, $data);
        }
    }
}