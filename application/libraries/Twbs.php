<?php

class Twbs extends Assets{

    private $dir = 'bootstrap';
    private $nav = 'nav';

    function __construct($data = FALSE){
        parent::__construct($data);
        $this->build();
    }

    private function build(){
        $this->nav = $this->dir.DIRECTORY_SEPARATOR.$this->nav;
    }

    public function nav(){
        return $this->nav;
    }

    public function form($model){
        $form = $model->get_form();
        if($action){
            $form->action = $action;
        }
        $autofocus_set = FALSE;
        foreach ($form->fields as $key => $value) {
            if(!@$value->id){
                $value->id = $value->name;
            }
            $value->class = 'form-control';
            $value->error = @form_error($value->name);
            $value->autofocus = FALSE;
            if(!$autofocus_set){
                $value->autofocus = (!@set_value($value->name) OR $value->error);
            }
            if($value->autofocus){
                $form->autofocus_id = $value->name;
                $autofocus_set = TRUE;
            }
            if($initial_data){
                $value->value = @$initial_data->{$value->name};
            }
            $value->input_element = input_element($value->type, $value);
        }
        $result = $this->CI->load->view(
            'bootstrap/templates/form',
            ['data' => $form],
            TRUE
        );
        return $result;
    }
}