<?php

function drop_index_query($table_name, $index_name, $no_suffix = false) {
    $CI =& get_instance();
    $db_name = $CI->db->database;

    $index_name = strpos($index_name, '_INDEX') || $no_suffix
        ? $index_name
        : $index_name.'_INDEX';

    return 'ALTER TABLE `'.$db_name.'`.`'.$table_name.'` DROP INDEX `'.$index_name.'`;';
}

function create_index_query($table_name, $index_name, array $index_fields, $index_type = null) {
    $CI =& get_instance();
    $db_name = $CI->db->database;

    $index_type = strtoupper($index_type);
    $index_name = strpos($index_name, '_INDEX')
        ? $index_name
        : $index_name.'_INDEX';

    array_walk($index_fields, function(&$index) {
        if(!strpos(strtolower($index), 'ASC') && !strpos(strtolower($index), 'DESC')) {
            $index = $index.' ASC';
        }
    });

    return $index_type
        ? "ALTER TABLE `$db_name`.`$table_name` ADD $index_type INDEX $index_name (".implode(', ', $index_fields).");"
        : "ALTER TABLE `$db_name`.`$table_name` ADD INDEX $index_name (".implode(', ', $index_fields).");";
}

if(!function_exists('is_absolute')){
    function is_absolute($url){
        if(strpos($url, '://') !== FALSE || substr($url,0,strlen('//')) == '//')return TRUE;
        return FALSE;
    }
}

if(!function_exists('create_link')){
    function create_link($uri){
        if(is_absolute($uri)){
            return $uri;
        }elseif($uri === '#'){
            return $uri;
        }else{
            return site_url($uri);
        }
    }
}

if(!function_exists('rpath')){
    function rpath($path){
        return DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR;
    }
}

if(!function_exists('is_cli_request')){
    function is_cli_request(){
        return (php_sapi_name() === 'cli' OR defined('STDIN'));
    }
}

if(!function_exists('append_string')){
    function append_string(&$text_to_append, $appendation){
        if($appendation != ''){
            $text_to_append = $text_to_append.' '.$appendation;
        }
        return $text_to_append;
    }
}

if(!function_exists('printl')){
    function printl($loop = 78, $char = '-', $nl = TRUE){
        if($loop == 0){
            if($nl){
                println();
            }
            return FALSE;
        } else {
            echo $char;
            printl(($loop-1), $char, $nl);
        }
    }
}

if(!function_exists('println')){
    function println($string = ''){
        if(is_cli_request()){
            echo $string;
            echo "\n";
        } else {
            echo $string;
            echo "<br>";
        }
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

if(!function_exists('scandir_files')){
    function scandir_files($path, $ext = 'json'){
        $list = scandir($path);
        $result = array_diff($list, [ ".", ".." ]);
        $result = array_filter($result, [new IsExtension($ext), 'check']);
        return array_values($result);
    }
}

class IsExtension{
    private $ext;

    function __construct($ext){
        $this->ext = $ext;
    }

    function check($value){
        $array = preg_split("/\./", $value);
        $ext = end($array);
        return $this->ext==$ext;
    }
}
