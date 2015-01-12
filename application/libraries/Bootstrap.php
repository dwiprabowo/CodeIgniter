<?php

class Bootstrap{

    private $CI = null;
    const TEMPLATE = 'bootstrap';

    /* NAVBAR PART */
    const NAVBAR_DEFAULT = 'default';
    const NAVBAR_INVERSE = 'inverse';
    const NAVBAR_TRANSPARENT = '';

    private $navbar_type = self::NAVBAR_DEFAULT;
    /* NAVBAR PART */

    /* CONTAINER PART */
    const CONTAINER_STARTER = 'starter';
    const CONTAINER_DASHBOARD = 'dashboard';
    const CONTAINER_BLANK = 'blank';

    private $container_type = self::CONTAINER_STARTER;
    /* CONTAINER PART */

    private $css = [];

    function __construct(){
        $this->init();
        $this->build_navbar();
        $this->build_container();
    }

    public function get_css(){
        return array_to_object($this->css);
    }

    private function add_css($item){
       $this->css[] = $item;
    }

    public function build(){
       $this->CI->_set_data('base_template', self::TEMPLATE);
       $this->CI->_set_data('navbar_type', $this->navbar_type);
       $this->CI->_set_data('container_type', $this->container_type);
    }

    private function init(){
        $this->CI =& get_instance();
    }

    private function build_navbar($navbar = FALSE){
        $navbar = $navbar?:$this->navbar_type;
        $this->navbar_type = 'navbar-'.$navbar;
    }

    private function build_container($container = FALSE){
        $container = $container?:$this->container_type;
        $this->container_type = $container;
    }

    private function empty_navbar(){
        $this->navbar_type = '';
    }

    public function set_navbar($type){
        switch ($type) {
            case self::NAVBAR_DEFAULT:
            case self::NAVBAR_INVERSE:
                $this->build_navbar($type);
                break;
            case self::NAVBAR_TRANSPARENT:
                $this->empty_navbar();
                break;
            default:
                $this->error('navbar');
                break;
        }
    }

    public function set_container($type){
        switch ($type) {
            case self::CONTAINER_STARTER:
            case self::CONTAINER_DASHBOARD:
            case self::CONTAINER_BLANK:
                $this->build_container($type);
                switch ($type) {
                    case self::CONTAINER_DASHBOARD:
                        $this->add_css(
                            [
                                'filename' => 'dashboard.css',
                                'rpath' => 'templates/css'
                            ]
                        );
                        break;
                }
                break;
            default:
                $this->error('container');
                break;
        }
    }

    private function error($label){
        show_error("Bootstrap library: unknown $label type");
    }

    function form($model, $initial_data = FALSE, $action = FALSE){
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
                $value->value = $initial_data->{$value->name};
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
