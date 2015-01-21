<?php

class Form_model extends MY_Model{

    function __construct(){
        parent::__construct();
        $this->load->helper('form');
    }

    public function set_form($value){
        if(isset($this->form['items'][$value])){
            $this->form['default'] = $value;
        }else{
            show_error('No form value found!');
        }
    }

    public function get_active_form(){
        return $this->form['default'];
    }

    public function get_form(){
        return array_to_object(
            $this->form['items'][$this->form['default']]
        );
    }

    protected function build_validator(){
        $this->set_form($this->input->post('active_item'));
        $form = $this->get_form();
        $this->validate = object_to_array($form->fields);
    } 
}