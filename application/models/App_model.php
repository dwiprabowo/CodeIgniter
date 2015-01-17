<?php

class App_Model extends MY_Model{

    private $lang = "";
    private $viewport = [
        'width' => 'device-width',
        'initial-scale' => '1',
    ];
    private $x_ua_compatible_equiv = "IE=edge";
    private $author = "dwi.juli.prabowo@gmail.com";
    private $description =
<<<EOD
Your description goes here ...
EOD;
    private $title = "Codeigniter & Bootstrap";
    private $enable_profiler = TRUE;

    function __construct(){
        parent::__construct();
        $this->build();
    }

    private function build(){
        $this->lang = config_item('country')[config_item('language')];
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