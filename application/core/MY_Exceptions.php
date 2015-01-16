<?php

if(!function_exists('is_cli_request')){
    function is_cli_request(){
        return (php_sapi_name() === 'cli' OR defined('STDIN'));
    }
}

class MY_Exceptions extends CI_Exceptions{
}
