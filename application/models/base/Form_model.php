<?php

class Form_model extends MY_Model{

    function __construct(){
        parent::__construct();
        $this->load->helper('form');
    }

    public function get_form(){
        return array_to_object(
            $this->form['items'][$this->form['default']]
        );
    }

    protected function build_validator(){
        $form = $this->get_form();
        $this->validate = object_to_array($form->fields);
    } 
}