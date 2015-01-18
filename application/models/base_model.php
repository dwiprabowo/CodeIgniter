<?php

class MY_Model extends CI_Model{
    
    function __construct(){
        parent::__construct();
        $this->load->model('Db_model');
    }
}