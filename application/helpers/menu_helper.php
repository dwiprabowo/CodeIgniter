<?php

if(!function_exists('is_currently_active')){
	function is_currently_active($list = FALSE){
		if(!$list){
			return;
		}
		$CI =& get_instance();
		foreach ($list as $k => $v) {
			$segment = explode('/', $v);
			if(count($segment) == 1){
				if($segment[0] == $CI->router->class){
					return 'active';
				}
			}
		}
	}
}