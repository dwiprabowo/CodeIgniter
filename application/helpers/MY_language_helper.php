<?php

if(!function_exists('t'))
{
    function t($line, $for = '', $attributes = array())
    {
        $line = get_instance()->lang->line($line);
        if ($for !== '')
        {
            $line = '<label for="'.$for.'"'._stringify_attributes($attributes).'>'.$line.'</label>';
        }
        return $line;
    }
}
