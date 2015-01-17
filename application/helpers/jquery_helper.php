<?php

if(!function_exists('jquery')){
    function jquery($filename, $path = FALSE){
        $CI =& get_instance();
        return $CI->jquery->load($filename, $path);
    }
}