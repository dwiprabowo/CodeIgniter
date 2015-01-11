<?php

class MY_Router extends CI_Router{
    public function get_uri_base(){
        $result =
            $this->directory
            .$this->class
            .'/'
            .$this->method;
        return $result;
    }
}