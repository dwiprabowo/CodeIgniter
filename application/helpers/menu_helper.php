<?php

if(!function_exists('is_active')){
    function is_active($active){
        $CI =& get_instance();
        if(is_object($active)){
            $active = object_to_array($active);
        }
        if(is_array($active)){
            foreach($active as $k => $v){
                if(strtolower($CI->router->class) === $v){
                    return 'active';
                }
            }
        }
        return "";
    }
}