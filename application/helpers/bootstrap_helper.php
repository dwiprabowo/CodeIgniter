<?php

if(!function_exists('bool_icon')){
    function bool_icon($value){
        $class = "glyphicon glyphicon-remove text-danger";
        if($value){
            $class = "glyphicon glyphicon-ok text-success";
        }
        return "<span class='$class'></span>";
    }
}
