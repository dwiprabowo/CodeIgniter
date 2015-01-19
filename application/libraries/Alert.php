<?php

class Alert{

    protected $ci = null;

    var $session = null;
    public $items = [];

    function __construct(){
        $this->ci =& get_instance();
        $this->session =& get_instance()->session;
        $this->ci->load->helper('alert');
    }

    private function set($message, $type, $instant = FALSE){
        if($instant){
            $this->items[] = [
                'type' => $type,
                'message' => $message,
            ];
        }else{
            $this->session->set_flashdata(
                'alert',
                [
                    'type' => $type,
                    'message' => $message,
                ]
            );
        }
    }

    public function error($message, $instant = FALSE){
        $this->set($message, 'error', $instant);
    }

    public function success($message, $instant = FALSE){
        $this->set($message, 'success', $instant);
    }
}
