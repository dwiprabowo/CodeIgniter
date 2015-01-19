<?php

if(!function_exists('ialert_error')){
    function ialert_error($message){
        $CI =& get_instance();
        $CI->alert->error($message, TRUE);
    }
}

if(!function_exists('ialert_success')){
    function ialert_success($message){
        $CI =& get_instance();
        $CI->alert->success($message, TRUE);
    }
}

if(!function_exists('alert_error')){
    function alert_error($message){
        $CI =& get_instance();
        $CI->alert->error($message);
    }
}

if(!function_exists('alert_success')){
    function alert_success($message){
        $CI =& get_instance();
        $CI->alert->success($message);
    }
}
