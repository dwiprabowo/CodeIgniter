<?php

if(!function_exists('assets')){
    function assets($filename, $path = FALSE){
        $CI =& get_instance();
        return $CI->assets->load($filename, $path);
    }
}