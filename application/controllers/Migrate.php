<?php

class Migrate extends CLI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper('database');
        $this->load->library('migration');
        color('cyan', 'bold');
        echo "\n";
        echo str_repeat("-", self::CLI_VIEW_WIDTH);
        echo "\n";
        echo "running migrate cli {$this->router->class}-{$this->router->method} ...";
        echo "\n";
        $this->check_info('current');
        color('green', 'bold');
        echo str_repeat("-", self::CLI_VIEW_WIDTH);
        echo "\n";
        color_reset();
        register_shutdown_function(array($this, 'end_message'));
    }

    function end_message(){
        color('green', 'bold');
        echo str_repeat("-", self::CLI_VIEW_WIDTH);
        echo "\n";
        color_reset();
        $this->check_info("after execution");
        color('cyan', 'bold');
        echo 'migrate cli run successfully, exiting...';
        echo "\n";
        echo str_repeat("-", self::CLI_VIEW_WIDTH);
        echo "\n";
    }

    function check_info($label){
        color_reset();
        echo "\n";
        echo "$label database info ...";
        echo "\n";
        $this->show_info();
        echo "\n";
    }

    public function index(){
        if(!$this->migration->latest()){
            show_error($this->migration->error_string());
        }
    }

    public function version($number=0){
        if($this->migration->version($number) === FALSE){
            show_error($this->migration->error_string());
        }
    }

    private function show_info(){
        $this->check_current_version();
        $this->check_available_tables();
    }

    public function check_available_tables($print = TRUE){
        $query = "SELECT table_name AS name 
            FROM information_schema.tables 
            WHERE table_schema = DATABASE()
        ";
        $query = $this->db->query($query);
        $values = $query->result_object();
        echo 'Table List:';
        echo "\n";
        foreach($values as $v){
            echo " - ".$v->name;
            echo "\n";
        }
        color_reset();
    }

    public function check_current_version($print = TRUE){
        $version = $this->migration->version_number();
        echo "\n";
        echo color('red', 'bold', TRUE)."current version is: $version ".color_reset(TRUE);
        echo "\n";
        color_reset();
    }
}
