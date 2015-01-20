<?php

class App_Model extends MY_Model{

    function __construct(){
        parent::__construct();
        $this->load->config('app');
        $this->build();
    }

    private function build(){
        $this->lang = config_item(APP_PREFIX."lang");
        $this->x_ua_compatible_equiv = config_item(APP_PREFIX."x_ua_compatible_equiv");
        $this->author = config_item(APP_PREFIX."author");
        $this->description = config_item(APP_PREFIX."description");
        $this->title = config_item(APP_PREFIX."title");
        $this->enable_profiler = config_item(APP_PREFIX."enable_profiler");
        $this->viewport = config_item(APP_PREFIX."viewport");
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