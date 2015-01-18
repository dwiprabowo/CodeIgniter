<?php

if(!function_exists('change_color')){
    function color($color, $var = FALSE, $return = FALSE){
        $color_list = [
            "black"     => "\e[%0m", # Black - Regular
            "red"       => "\e[%1m", # Red
            "green"     => "\e[%2m", # Green
            "yellow"    => "\e[%3m", # Yellow
            "blue"      => "\e[%4m", # Blue
            "purple"    => "\e[%5m", # Purple
            "cyan"      => "\e[%6m", # Cyan
            "white"     => "\e[%7m", # White
            "reset"     => "\e[0m"    # Text Reset
        ];
        $variations = [
            'reg'   => '0;3',
            'bold'  => '1;3',
            'udln'  => '4;3',
            'bkgr'  => '4',
        ];

        $var = $var?:'reg';
        $color_code = str_replace('%', $variations[$var], $color_list[$color]);
        if($return){
            return "$color_code";
        }
        echo "$color_code";
    }
}

if(!function_exists('color_reset')){
    function color_reset($return = FALSE){
        return color('reset', FALSE, $return);
    }
}
