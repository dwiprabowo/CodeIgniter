<?php

class AutoView{
    public function run(){
        $CI =& get_instance();
        if(@$CI->bootstrap){
            $CI->bootstrap->build();
        }
        if($CI->input->is_cli_request() || is_cli_request()){
            return FALSE;
        }
        $CI->_build();
        $template = $CI->_get_data('base_template');
        $CI->load->view($template, $CI->_get_data());
    }
}
