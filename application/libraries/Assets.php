<?php

class Assets{

    const DIR   = 'assets/';
    const THIRDPARTY_DIR = 'thirdparty/';

    const CSS   = 'css';
    const JS    = 'js';
    const IMG   = 'img';

    var $path = self::DIR;

    var $thirdparty = NULL;

    function __construct(){
        $this->init_thirdparty();
    }

    function bulk($items){
        foreach ($items as $item) {
            echo $this->load($item->filename, $item->rpath);
        }
    }

    function init_thirdparty(){
        $this->thirdparty = new stdClass;
        $this->thirdparty_inactivate();
    }

    function thirdparty($name){
        $this->thirdparty_activate();
        $this->thirdparty->name = strtolower($name);
        $this->thirdparty->dir = $this->thirdparty->name.DIRECTORY_SEPARATOR;
    }

    function thirdparty_active(){
        return $this->thirdparty->active;
    }

    function thirdparty_inactivate(){
        $this->thirdparty->active = FALSE;
    }

    function thirdparty_activate(){
        $this->thirdparty->active = TRUE;
    }

    function load($filename, $path = FALSE){
        $type = explode('.', $filename);
        $original_type = $type = end($type);
        $one_of_img_type = in_array($type, config_item('assets_img'));
        if($one_of_img_type){
            $type = self::IMG;
        }
        if($this->thirdparty_active() AND $path === FALSE){
            show_error('A thirdparty assets need to specify the path!');
            die;
        }
        if($path === FALSE){
            $this->{'cd_'.$type}();
        }elseif(!$this->thirdparty_active()){
            $this->{'cd_'.$type}($path);
        }else{
            $this->cd($path);
        }
        switch ($type) {
            case self::CSS:
                    return link_tag($this->path.$filename);
                break;
            case self::JS:
                    return script_tag($this->path.$filename);
                break;
            case self::IMG:
                    if($original_type === "ico"){
                        return link_tag($this->path.$filename, 'icon');
                    }
                    return img($this->path.$filename);
                break;
            default:
                show_error('Unknow Assets Type!');
                break;
        }
    }

    function cd($rpath){
        $thirdparty_path = '';
        if($this->thirdparty_active()){
            $thirdparty_path = self::THIRDPARTY_DIR.$this->thirdparty->dir;
        }
        $this->path = self::DIR.$thirdparty_path.$rpath.DIRECTORY_SEPARATOR;
    }

    function cd_css($path = FALSE){
        $this->cd(self::CSS.($path?rpath($path):''));
    }

    function cd_js($path = FALSE){
        $this->cd(self::JS.($path?rpath($path):''));
    }

    function cd_img($path = FALSE){
        $this->cd(self::IMG.($path?rpath($path):''));
    }


}
