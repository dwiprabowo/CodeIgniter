<?php

if(!function_exists('string_contain')){
    function string_contain($subject, $contain){
        if(strpos($subject, $contain) !== FALSE){
            return TRUE;
        }
        return FALSE;
    }
}

if(!function_exists('array_to_object')){
    function array_to_object($d){
        return is_array($d)?(object) array_map(__FUNCTION__, $d):$d;
    }
}

if(!function_exists('object_to_array')){
    function object_to_array($d){
        if(is_object($d)){
            $d = (array) $d;
        }
        return is_array($d)?array_map(__FUNCTION__, $d):$d;
    }
}

if(!function_exists('is_cli_request')){
    function is_cli_request(){
        return (php_sapi_name() === 'cli' OR defined('STDIN'));
    }
}

if(!function_exists('rpath')){
    function rpath($path){
        $value = DIRECTORY_SEPARATOR;
        if($path){
            $value = DIRECTORY_SEPARATOR.$path.$value;
        }
        return $value;
    }
}

if(!function_exists('d')){
    function d($object){
        if(!is_cli_request()){
            echo '<pre>';
        }
        if(is_array($object)){
            echo json_encode($object);
        } else {
            var_dump($object);
        }
        if(!is_cli_request()){
            echo '</pre>';
        }
    }
}
