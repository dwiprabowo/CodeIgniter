<?php

class MY_Migration extends CI_Migration{

    function __construct($config = []){
        parent::__construct($config);
    }

    public function version_number(){
        return $this->_get_version();
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
        if (empty($migrations))
        {
            return TRUE;
        }
        $previous = FALSE;
        foreach ($migrations as $number => $file)
        {
            if ($this->_migration_type === 'sequential' && $previous !== FALSE && abs($number - $previous) > 1)
            {
                $this->_error_string = sprintf($this->lang->line('migration_sequence_gap'), $number);
                return FALSE;
            }
            include_once($file);
            $class = 'Migration_'.ucfirst(strtolower($this->_get_migration_name(basename($file, '.php'))));
            if ( ! class_exists($class, FALSE))
            {
                $this->_error_string = sprintf($this->lang->line('migration_class_doesnt_exist'), $class);
                return FALSE;
            }
            $previous = $number;
            if (
                ($method === 'up'   && $number > $current_version && $number <= $target_version) OR
                ($method === 'down' && $number <= $current_version && $number > $target_version)
            )
            {
                $instance = new $class();
                if ( ! is_callable(array($instance, $method)))
                {
                    $this->_error_string = sprintf($this->lang->line('migration_missing_'.$method.'_method'), $class);
                    return FALSE;
                }

                log_message('debug', 'Migrating '.$method.' from version '.$current_version.' to version '.$number);
                call_user_func(array($instance, $method));
                $current_version = $number;
                $this->_update_version($current_version);
            }
        }
        if ($current_version <> $target_version)
        {
            $current_version = $target_version;
            $this->_update_version($current_version);
        }
        log_message('debug', 'Finished migrating to '.$current_version);
        return $current_version;
    }
}