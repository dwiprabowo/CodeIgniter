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
        echo "\n";
        register_shutdown_function(array($this, 'end_message'));
    }

    function end_message(){
        color('cyan', 'bold');
        echo "\n";
        echo 'migrate cli run successfully, exiting...';
        echo str_repeat("-", self::CLI_VIEW_WIDTH);
        echo "\n";
    }

    public function index(){
        color('green', 'bold');
        echo 'version before ...';
        echo "\n";
        $this->show_info();
        if(!$this->migration->latest()){
            show_error($this->migration->error_string());
        }
        echo "\n";
        color('green', 'bold');
        echo 'version after ...';
        echo "\n";
        $this->show_info();
    }

    public function version($number=0){
        color('green', 'bold');
        echo 'version before ...';
        echo "\n";
        $this->show_info();
        if($this->migration->version($number) === FALSE){
            show_error($this->migration->error_string());
        }
        echo "\n";
        color('green', 'bold');
        echo 'version after ...';
        echo "\n";
        $this->show_info();
    }

    private function show_info(){
        $this->check_current_version();
        $this->check_available_tables();
    }

    public function check_available_tables($print = TRUE){
        $query = "SELECT table_name AS name FROM information_schema.tables WHERE table_schema = DATABASE()";
        $query = $this->db->query($query);
        $values = $query->result_object();
        color('yellow', 'bold');
        echo 'Table List:';
        echo "\n";
        color('yellow');
        foreach($values as $v){
            echo " - ".$v->name;
            echo "\n";
        }
        color_reset();
    }

    public function check_current_version($print = TRUE){
        $query = "SELECT * FROM migrations";
        $query = $this->db->query($query);
        $version = $query->row()->version;
        color('red');
        echo str_repeat("-", self::CLI_VIEW_WIDTH);
        echo "\n";
        printf("| ".color('red', 'bold', TRUE)."current version is: %-54s ".color('red', 'reg', TRUE)."|\n", $version);
        echo str_repeat("-", self::CLI_VIEW_WIDTH);
        echo "\n";
        color_reset();
    }
}
