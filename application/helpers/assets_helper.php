<?php

if(!function_exists('assets')){
    function assets($filename, $path_or_attributes = FALSE, $path = FALSE){
        $CI =& get_instance();
        if(is_array($path_or_attributes)){
            return $CI->assets->load_file($filename, $path_or_attributes, $path);
        }
        return $CI->assets->load($filename, $path_or_attributes);
    }
}