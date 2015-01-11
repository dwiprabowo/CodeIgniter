<?php

class Migrate extends MY_Controller{

    function __construct(){
        parent::__construct();
        if(!$this->input->is_cli_request()){
            show_error(
                'Please execute the command via CLI!',
                403
            );
        }
        $this->load->library('migration');
    }

    public function index(){
        $this->show_info();
        if(!$this->migration->latest()){
            show_error($this->migration->error_string());
        }
        $this->show_info();
    }

    public function version($number=0){
        $this->show_info();
        if($this->migration->version($number) === FALSE){
            show_error($this->migration->error_string());
        }
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
        println();
        printl(40);
        println('Table List:');
        printl(40);
        foreach($values as $v){
            println($v->name);
        }
        printl(40);
        println();
    }

    public function check_current_version($print = TRUE){
        $query = "SELECT * FROM migrations";
        $query = $this->db->query($query);
        $version = $query->row()->version;
        println('current version is: '.$version);
    }
}
