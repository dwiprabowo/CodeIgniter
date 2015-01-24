<?php

class MY_Migration extends CI_Migration{

    const KEYWORD_CREATE_TABLE = "add";
    public $migration_info = null;

    function __construct($config = []){
        parent::__construct($config);
        $this->migration_info = new stdClass;
    }

    public function version_number(){
        return $this->_get_version();
    }

    protected function show_migration_method_info($method){
        if(!is_cli_request()){
            return;
        }
        echo $method."grading database - please wait ... ";
        echo "\n";
    }

    protected function show_migration_progress($number, $file){
        if(!is_cli_request()){
            return;
        }
        $name = 
            ucfirst(strtolower($this->_get_migration_name(basename($file, '.php'))));
        echo "... $number - $name ... ";
        echo "\n";
    }

    public function version($target_version)
    {
        $current_version = $this->_get_version();
        if($this->_migration_type === 'sequential'){
            $target_version = sprintf('%03d', $target_version);
        }else{
            $target_version = (string) $target_version;
        }

        $migrations = $this->find_migrations();
        if($target_version > 0 && ! isset($migrations[$target_version])){
            $this->_error_string = sprintf($this->lang->line('migration_not_found'), $target_version);
            return FALSE;
        }

        if($target_version == $current_version){
            $this->_error_string = sprintf(
                "target version and current version is same..."
                , $target_version
            );
            return FALSE;
        }elseif($target_version > $current_version){
            $method = 'up';
        }else{
            $method = 'down';
            krsort($migrations);
        }

        $this->show_migration_method_info($method);

        if(empty($migrations)){
            return TRUE;
        }
        $previous = FALSE;
        foreach($migrations as $number => $file){
            if(
                $this->_migration_type === 'sequential' 
                AND $previous !== FALSE AND abs($number - $previous) > 1
            ){
                $this->_error_string = sprintf($this->lang->line('migration_sequence_gap'), $number);
                return FALSE;
            }
            include_once($file);
            $migration_name = 
                ucfirst(strtolower($this->_get_migration_name(basename($file, '.php'))));
            $class = 'Migration_'.$migration_name;
            if(!class_exists($class, FALSE)){
                $this->_error_string = sprintf($this->lang->line('migration_class_doesnt_exist'), $class);
                return FALSE;
            }
            $previous = $number;
            if(
                (
                    $method === 'up' 
                    AND $number > $current_version 
                    AND $number <= $target_version
                ) 
                OR
                (
                    $method === 'down' 
                    AND $number <= $current_version 
                    AND $number > $target_version
                )
            ){
                $instance = new $class();
                if($this->_migration_type === 'sequential'){
                    if($number === "000"){
                        $instance->skip_action = TRUE;
                    }else{
                        $instance->migration_info = $this->parse_name($migration_name);
                    }
                }
                $this->show_migration_progress($number, $file);
                if(!is_callable(array($instance, $method))){
                    $this->_error_string = 
                        sprintf(
                            $this->lang->line('migration_missing_'.$method.'_method')
                            , $class
                        );
                    return FALSE;
                }
                log_message(
                    'debug'
                    , 'Migrating '
                    .$method
                    .' from version '
                    .$current_version
                    .' to version '
                    .$number
                );
                call_user_func(array($instance, $method));
                $current_version = $number;
                $this->_update_version($current_version);
            }
        }
        if($current_version <> $target_version){
            $current_version = $target_version;
            $this->_update_version($current_version);
        }
        log_message('debug', 'Finished migrating to '.$current_version);
        return $current_version;
    }

    private function parse_name($name){
        $segments = array_map('strtolower', explode('_', $name));
        $keyword = $segments[0];
        switch ($keyword) {
            case self::KEYWORD_CREATE_TABLE:
                $tablename = end($segments);
                break;
            default:
                show_error("Unknown keyword!");
                break;
        }
        $result = new stdClass;
        $result->keyword = $keyword;
        $result->tablename = $tablename;
        return $result;
    }

    public function up(){
        if(!isset($this->migration_info->keyword)){
            return;
        }
        switch ($this->migration_info->keyword) {
            case self::KEYWORD_CREATE_TABLE:
                $this->dbforge->add_field('id');
                $this->dbforge->add_field($this->fields);
                $this->dbforge->create_table($this->migration_info->tablename);
                break;
            default:
                show_error("Unknown keyword!");
                break;
        }
    }

    public function down(){
        if(!isset($this->migration_info->keyword)){
            return;
        }
        switch ($this->migration_info->keyword) {
            case self::KEYWORD_CREATE_TABLE:
                $this->dbforge->drop_table($this->migration_info->tablename);
                break;
            default:
                show_error("Unknown keyword!");
                break;
        }
    }
}