<?php

class Crud_model extends Db_Model{

    function __construct(){
        parent::__construct();
        $this->load->helper('crud');
    }

    public function filter_data($data){
        $filtered_data = [];
        $this->get_fields_from_real_table();
        $fields = $this->fields;
        foreach ($fields as $k => $v) {
            $field_name = $v;
            if(isset($data[$field_name])){
                $filtered_data[$field_name] = $data[$field_name];
            }
        }
        return $filtered_data;
     }
     
    protected function get_fields_from_real_table(){
        $query = "SELECT column_name AS field
            FROM information_schema.columns
            WHERE
                table_schema = '{$this->db->database}'
                AND table_name = '$this->_table'
        ";
        $this->fields = array_column(
            $this->db->query($query)->result_array()
            , 'field'
        );
    }
    
}