<?php

class Assets{

    protected $ci = null;

    private $dir    = 'assets/';
    private $dist   = FALSE;
    const THIRDPARTY_DIR = 'thirdparty/';

    const CSS   = 'css';
    const JS    = 'js';
    const IMG   = 'img';

    private $path = '';

    var $thirdparty = NULL;

    function __construct($data = FALSE){
        $this->ci =& get_instance();
        if($data){
            $this->build($data);
        }
        $this->ci->load->helper('assets');
    }

    private function build($data){
        if(isset($data['root_path'])){
            $this->dir = $data['root_path'];
        }
        if(isset($data['dist'])){
            $this->dist = $data['dist'];
        }
        if(isset($data['helper'])){
            $this->ci->load->helper($data['helper']);
        }
    }

    function load_file($filename, $attributes = [], $path = FALSE){
        $type = explode('.', $filename);
        $original_type = $type = end($type);
        $one_of_img_type = in_array($type, config_item('assets_img'));
        if($one_of_img_type){
            $type = self::IMG;
        }
        if($path === FALSE){
            $this->{'cd_'.$type}();
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
                    $data = $this->path.$filename;
                    if($attributes){
                        $data = ['src' => $this->path.$filename];
                        $data = array_replace_recursive($data, $attributes);
                    }
                    return img($data);
                break;
            default:
                show_error('Unknow Assets Type!');
                break;
        }
    }

    function load($filename, $path = FALSE){
        return $this->load_file($filename, null, $path);
    }

    function cd($rpath){
        $this->path = $this->dir.$rpath;
    }

    function cd_css($path = FALSE){
        $this->cd($this->dist.self::CSS.rpath($path));
    }

    function cd_js($path = FALSE){
        $this->cd($this->dist.self::JS.rpath($path));
    }

    function cd_img($path = FALSE){
        $this->cd($this->dist.self::IMG.rpath($path));
    }


}
