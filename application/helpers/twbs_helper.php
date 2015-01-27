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
        return $CI->twbs->nav()->filepath;
    }
}

if(!function_exists('twbs_nav_color')){
    function twbs_nav_color(){
        $CI =& get_instance();
        return $CI->twbs->nav()->color;
    }
}

if(!function_exists('twbs_body_background_color')){
    function twbs_body_background_color(){
        $CI =& get_instance();
        return 
            isset($CI->twbs->body()->background_color)
                ?$CI->twbs->body()->background_color
                :FALSE;
    }
}

if(!function_exists('twbs_body_color')){
    function twbs_body_color(){
        $CI =& get_instance();
        return isset($CI->twbs->body()->color)?$CI->twbs->body()->color:FALSE;
    }
}

if(!function_exists('twbs_form')){
    function twbs_form($model, $initial_data = FALSE, $action = FALSE){
        $CI =& get_instance();
        return $CI->twbs->form($model, $initial_data, $action);
    }
}
