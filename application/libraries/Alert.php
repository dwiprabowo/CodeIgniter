<?php

class Alert{

    var $session = null;
    public $items = [];

    function __construct(){
        $this->session =& get_instance()->session;
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
