<?php

if(!function_exists('get_data_fields')){
    function get_data_fields($data){
        if(is_array($data)){
            if(count($data) > 0){
                if(is_object($data[0])){
                    $data = object_to_array($data);
                }
                return array_keys($data[0]);
            }
        }elseif(is_object($data)){
            $data = object_to_array($data);
            return array_keys($data);
        }
        return FALSE;
    }
}
