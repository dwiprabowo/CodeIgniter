<?php

class Menu_model extends MY_Model{

    function __construct(){
        parent::__construct();
        $this->init();
    }

    function init(){
        $this->load->config('menu');
        $this->load->helper('menu');
        $this->default_item = config_item('default_item');
        $this->items = config_item('menu');
        foreach($this->items as $k => $v){
            $this->items[$k] = array_replace_recursive(
                $this->default_item
                , $this->items[$k]
            );
            if(isset($this->items[$k]['items'])){
                foreach($this->items[$k]['items'] as $_k => $_v){
                    $this->items[$k]['items'][$_k] = array_replace_recursive(
                        $this->default_item
                        , $this->items[$k]['items'][$_k]
                    );
                }
            }
        }
    }

    function disable(){
        $this->disabled = TRUE;
    }

    function enable(){
        $this->disabled = FALSE;
    }

    public function items(){
        if(!$this->disabled){
            return array_to_object($this->items);
        }
        return FALSE;
    }
}