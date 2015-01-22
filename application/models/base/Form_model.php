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

    public function alter_form($data, $item_key = FALSE){
        if($item_key){
            $current = $this->form['items'][$this->form['default']];
            $this->form['items'][$this->form['default']] =
                array_replace_recursive($current, $data);
        }else{
            $this->form = array_replace_recursive($this->form, $data);
        }
    }

    public function get_active_form(){
        return $this->form['default'];
    }

    private function build_form(){
        $result = [];
        $current = $this->form['items'][$this->form['default']]['fields'];
        foreach($current as $k => $v){
            $field = $v;
            $field['field'] = $k;
            if(!isset($field['label'])){
                $field['label'] = ucfirst($k);
            }
            $result[] = $field;
        }
        $temp_form = $this->form['items'][$this->form['default']];
        $temp_form['fields'] = $result;
        return $temp_form;
    }

    public function get_form(){
        return array_to_object(
            $this->build_form()
        );
    }

    protected function build_validator(){
        $this->set_form($this->input->post('active_item'));
        $this->validate = object_to_array($this->get_form()->fields);
    } 
    
    public function set_dropdown($key, $data){
        $this->form
            ['items']
                [$this->form['default']]
                    ['fields']
                        [$key]
                            ['dropdown'] = $data;
    }

}