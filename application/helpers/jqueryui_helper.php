<?php

if(!function_exists('jqueryui')){
    function jqueryui($filename, $path = FALSE){
        $CI =& get_instance();
        return $CI->jqueryui->load($filename, $path);
    }
}
