<?php

class Menu_model extends MY_Model{

    private $default_item = [
        'label' => 'Menu',
        'action' => '#',
    ];

    private $menu = [];

    function __construct(){
        parent::__construct();
        $this->load->helper('menu');
        $this->menu = config_item('menu');
        $this->build();
    }

    private function build(){
        foreach($this->menu as $k => $v){
            $this->menu[$k] = array_replace_recursive(
                $this->default_item
                , $v
            );
            $have_menu = isset($v['menu']);
            if($have_menu){
                foreach($v['menu'] as $_k => $_v){
                    $this->menu[$k]['menu'][$_k] = 
                        array_replace_recursive($this->default_item, $_v);
                }
            }
        }
    }

    public function items(){
        return array_to_object($this->menu);
    }
}