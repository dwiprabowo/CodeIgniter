<?php

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
