<?php


if(!function_exists('twbs')){
    function twbs($filename, $path = FALSE){
        $CI =& get_instance();
        return $CI->twbs->load($filename, $path);
    }
}