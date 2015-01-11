<?php

class MY_Form_validation extends CI_Form_validation{

    public function run($group = '')
    {
        $result = parent::run($group);
        foreach ($this->_field_data as $key => $value) {
            $this->CI->session->add_form_value(
                $key, 
                $this->_field_data[$key]['postdata']
            );
        }
        return $result;
    }

    protected function _execute($row, $rules, $postdata = NULL, $cycles = 0)
    {
        if (is_array($postdata))
        {
            foreach ($postdata as $key => $val)
            {
                $this->_execute($row, $rules, $val, $cycles);
                $cycles++;
            }

            return;
        }
        $callback = FALSE;
        if ( ! in_array('required', $rules) AND is_null($postdata))
        {
            if (preg_match("/(callback_\w+(\[.*?\])?)/", implode(' ', $rules), $match))
            {
                $callback = TRUE;
                $rules = (array('1' => $match[1]));
            }
            else
            {
                return;
            }
        }
        if (is_null($postdata) AND $callback == FALSE)
        {
            if (in_array('isset', $rules, TRUE) OR in_array('required', $rules))
            {
                $type = (in_array('required', $rules)) ? 'required' : 'isset';
                if ( ! isset($this->_error_messages[$type]))
                {
                    if (FALSE === ($line = $this->CI->lang->line($type)))
                    {
                        $line = 'The field was not set';
                    }
                }
                else
                {
                    $line = $this->_error_messages[$type];
                }
                $message = sprintf($line, $this->_translate_fieldname($row['label']));
                $this->_field_data[$row['field']]['error'] = $message;

                if ( ! isset($this->_error_array[$row['field']]))
                {
                    $this->_error_array[$row['field']] = $message;
                    $this->CI->session->add_form_error(
                        $row['field'],
                        $message
                    );
                }
            }

            return;
        }
        foreach ($rules As $rule)
        {
            $_in_array = FALSE;
            if ($row['is_array'] == TRUE AND is_array($this->_field_data[$row['field']]['postdata']))
            {
                if ( ! isset($this->_field_data[$row['field']]['postdata'][$cycles]))
                {
                    continue;
                }
                $postdata = $this->_field_data[$row['field']]['postdata'][$cycles];
                $_in_array = TRUE;
            }
            else
            {
                $postdata = $this->_field_data[$row['field']]['postdata'];
            }
            $callback = FALSE;
            if (substr($rule, 0, 9) == 'callback_')
            {
                $rule = substr($rule, 9);
                $callback = TRUE;
            }
            $param = FALSE;
            if (preg_match("/(.*?)\[(.*)\]/", $rule, $match))
            {
                $rule   = $match[1];
                $param  = $match[2];
            }
            if ($callback === TRUE)
            {
                if ( ! method_exists($this->CI, $rule))
                {
                    continue;
                }
                $result = $this->CI->$rule($postdata, $param);
                if ($_in_array == TRUE)
                {
                    $this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
                }
                else
                {
                    $this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
                }
                if ( ! in_array('required', $rules, TRUE) AND $result !== FALSE)
                {
                    continue;
                }
            }
            else
            {
                if ( ! method_exists($this, $rule))
                {
                    if (function_exists($rule))
                    {
                        $result = $rule($postdata);

                        if ($_in_array == TRUE)
                        {
                            $this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
                        }
                        else
                        {
                            $this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
                        }
                    }
                    else
                    {
                        log_message('debug', "Unable to find validation rule: ".$rule);
                    }

                    continue;
                }
                $result = $this->$rule($postdata, $param);
                if ($_in_array == TRUE)
                {
                    $this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
                }
                else
                {
                    $this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
                }
            }
            if ($result === FALSE)
            {
                if ( ! isset($this->_error_messages[$rule]))
                {
                    if (FALSE === ($line = $this->CI->lang->line($rule)))
                    {
                        $line = 'Unable to access an error message corresponding to your field name.';
                    }
                }
                else
                {
                    $line = $this->_error_messages[$rule];
                }
                if (isset($this->_field_data[$param]) AND isset($this->_field_data[$param]['label']))
                {
                    $param = $this->_translate_fieldname($this->_field_data[$param]['label']);
                }
                $message = sprintf($line, $this->_translate_fieldname($row['label']), $param);
                $this->_field_data[$row['field']]['error'] = $message;
                $this->CI->session->add_form_error(
                    $row['field'],
                    $message
                );
                if ( ! isset($this->_error_array[$row['field']]))
                {
                    $this->_error_array[$row['field']] = $message;
                }

                return;
            }
        }
    }

    public function error($field = '', $prefix = '', $suffix = ''){
        $session_data = $this->CI->session->get_form_error($field);
        if(
            (
                !isset($this->_field_data[$field]['error'])
                OR $this->_field_data[$field]['error'] == ''
            )
            AND !$session_data
        ){
            return '';
        }
        if($prefix == ''){
            $prefix = $this->_error_prefix;
        }
        if($suffix == ''){
            $suffix = $this->_error_suffix;
        }
        $result = $prefix.(@$this->_field_data[$field]['error']?:$session_data).$suffix;
        return $result;
    }

    public function set_value($field = '', $default = '')
    {
        $session_value = 
            $this->CI->session->get_form_value($field);
        if ( ! isset($this->_field_data[$field]) AND !$session_value)
        {
            return $default;
        }
        $value = @$this->_field_data[$field]['postdata']?:$session_value;
        if (is_array($value))
        {
            return array_shift($value);
        }
        return $value;
    }
    
}