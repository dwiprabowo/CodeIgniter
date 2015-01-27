<?php

if(!function_exists('fontello')){
    function fontello($filename, $path = FALSE){
        $CI =& get_instance();
        return $CI->fontello->load($filename, $path);
    }
}
