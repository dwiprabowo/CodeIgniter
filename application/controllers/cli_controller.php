<?php

abstract class CLI_Controller extends Base_Controller{

    const CLI_VIEW_WIDTH = 78;

    function __construct(){
        parent::__construct();
        if(!$this->input->is_cli_request()){
            echo "You're not accessing via CLI. exiting...\n";
        }
        $this->load->helper('cli');
    }
    
}