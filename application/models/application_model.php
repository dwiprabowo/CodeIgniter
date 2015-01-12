<?php
class Application_Model extends MY_Model{

    protected $plural_name = 'application';
    protected $singular_name = 'application';

	private $table = [
		'name' => 'application'
	];
	protected $form = [
        'fields' => [
            [
                "name" => "name",
                "label" => "Name",
                "rules" => "required",
        		"value" => "Haka Motor",
            ],
            [
                "name" => "enable_profiler",
                "label" => "Profiler Enabled?",
                "type" => "bool",
        		"value" => TRUE,
            ],
            [
                "name" => "description",
                "label" => "Description",
                "rules" => "required",
                "type" => "textarea",
        		"value" => ""
            ]
        ],
        'submit' => 'Update'
	];
    private $template = [];

    protected $single_row_data = TRUE;

	function __construct(){
        parent::__construct();
		$this->table = array_to_object($this->table);
        $this->init_template();
        $this->change_form_value();
	}

    private function change_form_value(){
        $data_db = $this->get();
        foreach ($this->form['fields'] as $k => $v) {
            $this->form['fields'][$k]['value'] = $data_db->{$v['name']};
        }
    }

    private function init_template(){
        foreach ($this->form['fields'] as $k => $v) {
            $this->template[$v['name']] = $v['value'];
        }
        $this->template['ready'] = TRUE;
    }

	public function get(){
		$result = $this->record();
		return array_to_object($result);
	}

	private function table(){
		return $this->check_table($this->table->name);
	}

	private function record(){
		$result = $this->template;
		if($this->table()){
			$query = $this->db->get($this->table->name);
			$_result = @$query->row()->data;
			if($_result){
                $result = json_decode($_result);
                foreach ($result as $k => $v) {
                    if($v === "0" || $v === "1"){
                        if($v === "1"){
                            $result->{$k} = TRUE;
                        }else{
                            $result->{$k} = FALSE;
                        }
                    }
                }
                if(!empty($result)){
                    if(is_object($result)){
        				$result = object_to_array($result);
                    }
                }
				$result = array_merge($this->template, $result);
			}
		}else{
			$result['ready'] = FALSE;
		}
		return $result;
	}

    function check_table($table){
        $query = "SHOW TABLES LIKE '$table'";
        $query = $this->db->query($query);
        if(@$query->row()){
            return TRUE;
        }
        return FALSE;
    }

}
