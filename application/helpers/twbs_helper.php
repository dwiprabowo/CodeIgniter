<?php

if(!function_exists('twbs')){
    function twbs($filename, $path = FALSE){
        $CI =& get_instance();
        return $CI->twbs->load($filename, $path);
    }
}

if(!function_exists('twbs_nav')){
    function twbs_nav(){
        $CI =& get_instance();
        return $CI->twbs->nav();
    }
}

if(!function_exists('twbs_form')){
    function twbs_form($model){
        $CI =& get_instance();
        return $CI->twbs->form($model);
    }
}
