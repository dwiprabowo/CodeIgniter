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

