<?php

if(!function_exists('fontawesome')){
    function fontawesome($filename, $path = FALSE){
        $CI =& get_instance();
        return $CI->fontawesome->load($filename, $path);
    }
}