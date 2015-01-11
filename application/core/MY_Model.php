<?php

class MY_Model extends CI_Model{

    protected $plural_name;
    protected $singular_name;

    protected $_table;
    protected $primary_key = 'id';
    protected $return_type = 'object';
    protected $_temporary_return_type = NULL;

    protected $before_create = [];
    protected $after_create = [];
    protected $before_get = [];
    protected $after_get = [];

    private $validate = [];

    protected $_with = [];

    protected $belongs_to = [];
    protected $has_many = [];
    protected $has_one = [];

    protected $models = FALSE;

    protected $soft_delete = FALSE;
    protected $soft_delete_key = 'deleted';
    protected $_temporary_with_deleted = FALSE;
    protected $_temporary_only_deleted = FALSE;

    protected $form = [
        'title' => 'Form',
        'fields' => [],
        'submit' => 'Submit',
    ];

    private $form_field_tpl = [
        'type' => 'text'
    ];

    protected $single_row_data = FALSE;
    protected $single_row_field = "data";

    function __construct(){
        parent::__construct();
        $this->_table = $this->plural_name;
        $this->_temporary_return_type = $this->return_type;
        $this->generate_fields();
        $this->build_validator();
        $this->load_dependency_models($this->models);
    }

    private function load_dependency_models($models){
        if(!$models){
            return;
        }
        foreach($models as $v){
            $this->load->model($v."_model");
        }
    }

    private function build_validator(){
        foreach ($this->form['fields'] as $key => $value) {
            $validate = [
                'field' => $value['name'],
                'label' => $value['label'],
                'rules' => @$value['rules']?:'',
            ];
            $this->validate[] = $validate;
        }
    }

    public function validation_rules($field, $rules){
        foreach ($this->validate as $key => $value) {
            if($this->validate[$key]['field'] === $field){
                $this->validate[$key]['rules'] = $rules;
                return;
            }
        }
    }

    function get_form($return_object=TRUE){
        $result = $this->form;
        if($return_object){
            $result = array_to_object($this->form);
        }
        return $result;
    }

    function generate_fields(){
        foreach ($this->form['fields'] as $key => $value) {
            $this->form['fields'][$key] = array_merge($this->form_field_tpl, $value);
        }
    }

    function get($primary_value = FALSE){
        $row = NULL;
        if($this->single_row_data AND !$primary_value){
            $query = $this->db->get($this->_table);
            if($query){
                $row = $query->row;
            }
        }elseif($primary_value){
            $this->trigger('before_get');
            $get = $this->db->where(
                $this->primary_key, $primary_value
            )->get($this->_table);
            if($get){
                $row = $get->{$this->_return_type()}();
            }
            if($row){
                $row = $this->trigger('after_get', $row);
            }
        }else{
            show_error("single_row_data is FALSE and You didn't provide the primary value");
        }
        return $row;
    }

    function all(){
        $this->trigger('before_get');

        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->db->where($this->soft_delete_key, (bool)$this->_temporary_only_deleted);
        }

        $result = $this->db->get($this->_table)
                           ->{$this->_return_type(1)}();
        $this->_temporary_return_type = $this->return_type;

        foreach ($result as $key => &$row)
        {
            $row = $this->trigger('after_get', $row, ($key == count($result) - 1));
        }

        $this->_with = array();
        return $result;
    }

    function insert($data){
        if(!$this->input->is_cli_request()){
            $data = $this->validate($data);
        }
        if($data !== FALSE){
            $data = $this->trigger('before_create', $data);
            if(!$this->single_row_data){
                $data = $this->generate_needed_data($data);
            }
            $insert_id = FALSE;
            if($this->single_row_data){
                $this->db->truncate($this->_table);
                $this->db->insert(
                    $this->_table
                    ,[
                        $this->single_row_field => json_encode($data)
                    ]
                );
                $insert_id = TRUE;
            }else{
                $this->db->insert($this->_table, $data);
                $insert_id = $this->db->insert_id();
            }
            $data[$this->singular_name.'_id'] = $insert_id;
            $this->trigger('after_create', $data);
            return $insert_id;
        }
        return FALSE;
    }

    function update($primary_value, $data){
        if($data !== FALSE){
            $result = $this->db->where($this->primary_key, $primary_value)
                        ->set($data)
                        ->update($this->_table);
            return $result;
        }
        return FALSE;
    }

    function generate_needed_data($data){
        $columns = $this->get_columns();
        $result = [];
        foreach($data as $k => $v){
            if(in_array($k, $columns)){
                $result[$k] = $v;
            }
        }
        return $result;
    }

    function get_columns(){
        $query = "SHOW COLUMNS IN $this->_table";
        $query = $this->db->query($query);
        $results = $query->{$this->_return_type(1)}();
        $fields = [];
        foreach($results as $k => $v){
            $fields[] = $v->Field;
        }
        return $fields;
    }

    function _return_type($multi = FALSE){
        $method = ($multi)?'result':'row';
        return $this->_temporary_return_type=='array'?$method.'_array':$method;
    }

    function set_table($name){
        $this->_table = $name;
    }

    function trigger($event, $data = FALSE, $last = TRUE){
        if(isset($this->$event) AND is_array($this->$event)){
            foreach($this->$event as $method){
                $data = call_user_func_array(array($this, $method), array($data, $last));
            }
        }
        return $data;
    }

    function validate($data){
        if(!empty($data) AND !empty($this->validate)){
            foreach($data as $k => $v){
                $_POST[$k] = $v;
            }
            $failed = FALSE;
            if(is_array($this->validate)){
                $this->form_validation->set_error_delimiters('', '');
                $this->form_validation->set_rules($this->validate);
                if($this->form_validation->run() === TRUE){
                    return $data;
                } else {
                    $failed = TRUE;
                }
            } else {
                if($this->form_validation->run($this->validate) === TRUE){
                    return $data;
                } else {
                    $failed = TRUE;
                }
            }
            if($failed){
                $this->alert->error('Error validating the form!');
                return FALSE;
            }
        } else {
            return $data;
        }
    }

    public function get_by(){
        $where = func_get_args();
        $this->_set_where($where);
        $this->trigger('before_get');
        $query = $this->db->get($this->_table);
        $row = NULL;
        if(@$query){
            $row = $query->{$this->_return_type()}();
        }
        $row = $this->trigger('after_get', $row);
        $this->_with = [];
        return $row;
    }

    public function get_many($values)
    {
        $this->db->where_in($this->primary_key, $values);

        return $this->all();
    }

    public function get_many_by()
    {
        $where = func_get_args();
        $this->_set_where($where);
        return $this->all();
    }

    function _set_where($params){
        if(count($params) == 1){
            $this->db->where($params[0]);
        } else {
            $this->db->where($params[0], $params[1]);
        }
    }

    function with($relationship){
        if(is_array($relationship)){
            $this->_with = $relationship;
        } else {
            $this->_with[] = $relationship;
        }

        if(!in_array('relate', $this->after_get)){
            $this->after_get[] = 'relate';
        }

        return $this;
    }

    public function relate($row){
        if(empty($row)){
            return $row;
        }

        foreach($this->belongs_to as $k => $v){
            if(is_string($v)){
                $relationship = $v;
                $options = [
                    'primary_key' => $v.'_id',
                    'model' => $v.'_model'
                ];
            } else {
                $relationship = $k;
                $options = $v;
            }

            $need_to_load_relation = (in_array($relationship, $this->_with) AND !empty($row));
            if($need_to_load_relation){
                $this->load->model($options['model']);
                if(is_object($row)){
                    $row->{$relationship} =
                        $this->
                        {$options['model']}->
                        get($row->{$options['primary_key']});
                } else {
                    $row[$relationship] =
                        $this->
                        {$options['model']}->
                        get($row[$options['primary_key']]);
                }
            }
        }

        foreach ($this->has_many as $k => $v)
        {
            if (is_string($v))
            {
                $relationship = $v;
                $options = [
                    'primary_key' => 'id',
                    'model' => $v. '_model'
                ];
            }
            else
            {
                $relationship = $k;
                $options = $v;
            }

            if (in_array($relationship, $this->_with))
            {
                $this->load->model($options['model'], $relationship . '_model');

                if (is_object($row))
                {
                    $row->{$relationship} = $this->{$relationship . '_model'}->get_many_by($options['primary_key'], $row->{$this->primary_key});
                }
                else
                {
                    $row[$relationship] = $this->{$relationship . '_model'}->get_many_by($options['primary_key'], $row[$this->primary_key]);
                }
            }
        }

        foreach ($this->has_one as $k => $v)
        {
            if (is_string($v))
            {
                $relationship = $v;
                $options = [
                    'primary_key' => 'id',
                    'model' => $v. '_model'
                ];
            }
            else
            {
                $relationship = $k;
                $options = $v;
            }

            if (in_array($relationship, $this->_with))
            {
                $this->load->model($options['model'], $relationship . '_model');

                if (is_object($row))
                {
                    $row->{$relationship} = $this->{$relationship . '_model'}->get_by($options['primary_key'], $row->{$this->primary_key});
                }
                else
                {
                    $row[$relationship] = $this->{$relationship . '_model'}->get_by($options['primary_key'], $row[$this->primary_key]);
                }
            }
        }

        $array_with = [];
        foreach($this->_with as $k => $v){
            if(is_array($v)){
                $array_with[$v[0]] = $k;
            }
        }

        return $row;
    }

}
