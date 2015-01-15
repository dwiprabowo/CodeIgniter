<?php

class AutoView{

    var $ci = null;

    function __construct(){
        $this->ci =& get_instance();
    }

    function run(){
        $template = $this->ci->template();
        $data = $this->ci->data();
        if($template){
            $this->ci->load->view($template, $data);
        }
    }
}