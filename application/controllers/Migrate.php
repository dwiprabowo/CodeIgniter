<?php

class Migrate extends CLI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper('database');
        $this->load->library('migration');
        color('cyan', 'bold');
        println();
        printl();
        println("running migrate cli {$this->router->class}-{$this->router->method} ...");
        println();
        register_shutdown_function(array($this, 'end_message'));
    }

    function end_message(){
        color('cyan', 'bold');
        println();
        println('migrate cli run successfully, exiting...');
        printl();
        println();
    }

    public function index(){
        color('green', 'bold');
        println('version before ...');
        $this->show_info();
        if(!$this->migration->latest()){
            show_error($this->migration->error_string());
        }
        println();
        color('green', 'bold');
        println('version after ...');
        $this->show_info();
    }

    public function version($number=0){
        color('green', 'bold');
        println('version before ...');
        $this->show_info();
        if($this->migration->version($number) === FALSE){
            show_error($this->migration->error_string());
        }
        println();
        color('green', 'bold');
        println('version after ...');
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
        println('Table List:');
        color('yellow');
        foreach($values as $v){
            println(" - ".$v->name);
        }
        color_reset();
    }

    public function check_current_version($print = TRUE){
        $query = "SELECT * FROM migrations";
        $query = $this->db->query($query);
        $version = $query->row()->version;
        color('red');
        printl();
        printf("| ".color('red', 'bold', TRUE)."current version is: %-54s ".color('red', 'reg', TRUE)."|\n", $version);
        printl();
        color_reset();
    }
}
