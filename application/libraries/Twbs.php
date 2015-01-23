<?php

class Twbs extends Assets{

    protected $ci = null;

    private $dir = 'bootstrap';
    private $nav = null;

    function __construct($data = FALSE){
        parent::__construct($data);
        $this->ci =& get_instance();
        $this->build();
        $this->ci->load->config('twbs');
        $this->init_nav();
        $this->init_body();
    }

    private function init_nav(){
        $this->nav = array_to_object(config_item('nav'));
        $this->nav->filepath = $this->dir.DIRECTORY_SEPARATOR.$this->nav->filename;
    }

    private function init_body(){
        $this->body = array_to_object(config_item('body'));
    }

    private function build(){
        $this->nav = $this->dir.DIRECTORY_SEPARATOR.$this->nav;
    }

    public function nav(){
        return $this->nav;
    }

    public function body(){
        return $this->body;
    }

    public function form($model, $initial_data = FALSE, $action = FALSE){
        $form = $model->get_form();
        if($action){
            $form->action = $action;
        }
        $form->active_item = $model->get_active_form();
        $autofocus_set = FALSE;
        foreach ($form->fields as $key => $value) {
            if($initial_data){
                $value->value = $initial_data->{$value->field};
            }
            if(!@$value->id){
                $value->id = $value->field;
            }
            $value->class = 'form-control';
            $value->error = @form_error($value->field);
            $value->autofocus = FALSE;
            if(!$autofocus_set){
                $value->autofocus = (!@set_value($value->field) OR $value->error);
            }
            if($value->autofocus){
                $form->autofocus_id = $value->field;
                $autofocus_set = TRUE;
            }
            $value->input_element = input_element($value->type, $value);
        }
        $result = $this->ci->load->view(
            'bootstrap/form',
            ['data' => $form],
            TRUE
        );
        return $result;
    }
}