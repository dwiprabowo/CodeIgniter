<?php

if(!function_exists('script_tag'))
{
    function script_tag($src = '', $language = 'javascript', $type = 'text/javascript', $index_page = FALSE, $html5 = true)
    {
        $CI =& get_instance();
        $script = '<scr'.'ipt';
        if (is_array($src))
        {
            foreach ($src as $k=>$v)
            {
                if ($k == 'src' AND strpos($v, '://') === FALSE)
                {
                    if ($index_page === TRUE)
                    {
                        $script .= ' src="'.$CI->config->site_url($v).'"';
                    }
                    else
                    {
                        $script .= ' src="'.$CI->config->slash_item('base_url').$v.'"';
                    }
                }
                else
                {
                    $script .= "$k=\"$v\"";
                }
            }
            $script .= "></scr'.'ipt>\n";
        }
        else
        {
            if ( strpos($src, '://') !== FALSE)
            {
                $script .= ' src="'.$src.'"';
            }
            elseif ($index_page === TRUE)
            {
                $script .= ' src="'.$CI->config->site_url($src).'"';
            }
            else
            {
                $script .= ' src="'.$CI->config->slash_item('base_url').$src.'"';
            }
            if(false == $html5)
            {
                $script .= ' language="'.$language;
                $script .= '" type="'.$type.'"';
            }
            $script .= '></scr'.'ipt>'."\n";
        }
        return $script;
    }
}

if(!function_exists('input_element')){
    function input_element($type, $data = FALSE){
        $CI =& get_instance();
        $result = "";
        switch ($type) {
            case INPUT_TYPE_TEXT:
            case INPUT_TYPE_PASSWORD:
            case INPUT_TYPE_TEXTAREA:
                $result = input_element_open($type);
                if($data){
                    $result .= input_element_content($type, $data);
                }else{
                    switch ($type) {
                        case INPUT_TYPE_TEXTAREA:
                            $result .= ">";
                            break;
                        default:
                            # code...
                            break;
                    }
                }
                $result .= input_element_close($type);
                break;
            case INPUT_TYPE_BOOL:
                if(is_object($data)){
                    $data = object_to_array($data);
                }
                $result = $CI->load->view(
                    'html_partial/input_type_bool'
                    ,['data' => $data]
                    , TRUE
                );
                break;
            default:
                # code...
                break;
        }
        return $result;
    }
}

if(!function_exists('input_element_open')){
    function input_element_open($type){
        $result = "";
        switch ($type) {
            case INPUT_TYPE_TEXT:
            case INPUT_TYPE_PASSWORD:
                $result = "<input type=";
                $result .= "'".$type."'";
                break;
            case INPUT_TYPE_TEXTAREA:
                $result = "<textarea rows='7'";
                break;
            case INPUT_TYPE_BOOL:
                $result = "";
            default:
                # code...
                break;
        }
        return $result;
    }
}

if(!function_exists('input_element_close')){
    function input_element_close($type){
        $result = "";
        switch ($type) {
            case INPUT_TYPE_TEXTAREA:
                $result .= "</textarea>";
                break;

            default:
                $result = ">";
                break;
        }
        return $result;
    }
}

if(!function_exists('input_element_content')){
    function input_element_content($type, $data){
        $result = "";
        if(is_object($data)){
            $data = (array) $data;
        }
        switch ($type) {
            case INPUT_TYPE_TEXT:
            case INPUT_TYPE_PASSWORD:
            case INPUT_TYPE_TEXTAREA:
                if(@$data['name']){
                    $result .= " name='{$data['name']}'";
                }
                if(@$data['id']){
                    $result .= " id='{$data['id']}'";
                }
                if(@$data['class']){
                    $result .= " class='{$data['class']}'";
                }
                if(@$data['error'] AND @$data['name'] ){
                    $result .= " aria-describedby='{$data['name']}_error'";
                }
                if(@$data['autofocus']){
                    $result .= " autofocus";
                }
                if(@$data['value'] AND @$data['name']){
                    if($type === INPUT_TYPE_TEXTAREA){
                        $result .= ">";
                    }
                    $value = @$data['value']?:NULL;
                    $value = set_value($data['name'], $value);
                    if($type === INPUT_TYPE_TEXTAREA){
                        $result .= $value;
                    }else{
                        $result .= " value='$value'";
                    }
                }elseif(@$data['name']){
                    if($type === INPUT_TYPE_TEXTAREA){
                        $result .= ">";
                    }
                    $value = set_value($data['name']);
                    if($type === INPUT_TYPE_TEXTAREA){
                        $result .= $value;
                    }else{
                        $result .= " value='$value'";
                    }
                }
                break;
            default:
                # code...
                break;
        }
        switch ($type) {
            case 'value':
                # code...
                break;

            default:
                # code...
                break;
        }
        return $result;
    }
}
