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
}