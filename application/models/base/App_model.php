<?php

class App_Model extends MY_Model{

    private $lang = "id";
    private $viewport = [
        'width' => 'device-width',
        'initial-scale' => '1',
    ];
    private $x_ua_compatible_equiv = "IE=edge";
    private $author = "dwi.juli.prabowo@gmail.com";
    private $description = "description here...";
    private $title = "App";
    private $enable_profiler = FALSE;

    function __construct(){
        parent::__construct();
        $this->build();
    }

    private function build(){
        $this->viewport = implode(
            ', '
            , array_map(
                function($v, $k){return "$k=$v";}
                , $this->viewport
                , array_keys($this->viewport)
            )
        );
    }

    public function author(){
        return $this->author;
    }

    public function description(){
        return $this->description;
    }

    public function viewport(){
        return $this->viewport;
    }

    public function x_ua_compatible_equiv(){
        return $this->x_ua_compatible_equiv;
    }

    public function title(){
        return $this->title;
    }

    public function enable_profiler(){
        return $this->enable_profiler;
    }

    public function lang(){
        return $this->lang;
    }
}