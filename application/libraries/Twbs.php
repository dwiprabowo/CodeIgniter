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