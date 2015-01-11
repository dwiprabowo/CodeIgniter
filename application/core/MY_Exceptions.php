<?php
if(!function_exists('is_cli_request')){
    function is_cli_request(){
        return (php_sapi_name() === 'cli' OR defined('STDIN'));
    }
}

class MY_Exceptions extends CI_Exceptions{
    function show_error($heading, $message, $template = 'error_custom', $status_code = 500){
    	$template = 'error_custom';
        $full_page_error = FALSE;
        if($status_code > 505){
            $status_code = $status_code - 505;
            $full_page_error = TRUE;
        }
    	set_status_header($status_code);
        if(is_cli_request()){
	        printl(50);
	        println($heading);
	        d($message);
	        return;
        }

		$message = ' '.implode(' ', ( ! is_array($message)) ? array($message) : $message).' ';

		if (ob_get_level() > $this->ob_level + 1)
		{
			ob_end_flush();
		}
		ob_start();
		include(APPPATH.'errors/'.$template.'.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
    }
}
