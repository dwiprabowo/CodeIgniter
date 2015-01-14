<?php

class MY_Controller extends CI_Controller{
    protected $data = [];
    protected $models = FALSE;
    protected $menus = [];
    protected $container_menus = [];

    protected $required_permission = [];

    private $allowed_http_methods = [
        'get', 'post'
    ];

    const MODEL_STRING = "%_model";

    function __construct(){
        parent::__construct();
        $this->load->model('application_model');
        $this->load->model('menu_model');
        $this->load->model('temp_model');
        $this->load->model('user_model');
        $this->init();
        $this->only_login();
        $this->check_permission();
    }

    private function only_login(){
        $no_login_required_page = [
            'login/index'
        ];
        if(
            !$this->temp_model->login() 
            AND !in_array($this->router->get_uri_base(), $no_login_required_page)){
            $this->alert->error("Please login first!");
            redirect();
        }
    }

    private function check_permission(){
        $id = $this->temp_model->login();
        foreach($this->required_permission as $k => $v){
            if(!in_array($v, $this->user_model->get_admin_data($id))){
                $this->alert->error("You don't have permission to access this Page!");
                redirect('home');
            }
        }
    }

    public function _build(){
        if($this->temp_model->login()){
            $this->_set_data('menus', array_to_object($this->menu_model->get()));
        }
        $this->_set_data('container_menus', array_to_object($this->container_menus));
        $this->_build_alert();
    }

    private function init(){
        $this->database();
        $this->init_path();
        $this->load_application();
        $this->init_model();
        $this->output->enable_profiler(
            is_cli_request()?FALSE:$this->_get_data('application')->enable_profiler
        );
        $this->init_rest();
        $id = $this->temp_model->login();
        if($id){
            $user = $this->user_model->get($id);
            $this->menu_model->actives($this->user_model->get_admin_data($id));
            $this->_add_menu(
                'login_indicator'
                , [
                    'label' => $user->name,
                    'is_dropdown' => TRUE,
                    'only_top' => TRUE,
                    'active' => TRUE,
                    'menus' => [
                        'logout' => [
                            'label' => 'Logout',
                            'action' => 'logout'
                        ]
                    ]
                ]
            );
        }
    }

    public function _add_menu($key, $item){
        $this->menu_model->add($key, $item);
    }

    private function database(){
        $connection = $this->db->conn_id;
        if(!$connection){
            $_error =& load_class('Exceptions', 'core');
            echo $_error->show_error(
                'Database connection Failed!'
                ,$this->load->view('database_error', null, TRUE)
                ,null
                ,906
            );
            die;
        }
    }

    private function init_path(){
        $this->directory = $this->router->fetch_directory();
        $this->class = $this->router->fetch_class();
        $this->method = $this->router->fetch_method();
        $this->path = $this->router->get_uri_base();
        $this->_set_data(
            'view',
            $this->path
        );
    }

    private function init_rest(){
        $this->request = new stdClass;
        $this->request->method = $this->detect_method();
    }

    private function detect_method(){
        $method = strtolower($this->input->server('REQUEST_METHOD'));
        if(in_array($method, $this->allowed_http_methods)){
            return $this->method = $method;
        }
    }

    public function _remap($method, $arguments){
        $controller_method = $method.'_'.$this->request->method;
        if(strtolower($this->request->method) == 'post'){
            $arguments[] = $this->input->post();
        }
        if(method_exists($this, $controller_method)){
            return call_user_func_array([$this, $controller_method], $arguments);
        }elseif(method_exists($this, $method)){
            return call_user_func_array([$this, $method], $arguments);
        }
        show_404();
    }

    private function init_model(){
        if(!$this->models){
            return;
        }
        if(is_array($this->models)){
            foreach ($this->models as $model) {
                $this->load_model($model);
            }
        }else{
            $this->load_model($this->models);
        }
    }

    private function load_model($model){
        $model_name = str_replace('%', $model, self::MODEL_STRING);
        $this->load->model($model_name);
        $this->_set_data($model_name, $this->{$model_name});
    }

    private function _build_alert(){
        $alerts = [];
        if(@$this->session->flashdata('alert')){
            $alerts[] = $this->session->flashdata('alert');
        }
        if(@$this->alert->items){
            foreach($this->alert->items as $item){
                $alerts[] = $item;
            }
        }
        foreach($alerts as $k => $v){
            if($v){
                switch($alerts[$k]['type']){
                    case 'error':
                        $alerts[$k]['label'] = 'danger';
                    break;
                    case 'success':
                        $alerts[$k]['label'] = 'success';
                    break;
                }
            }
        }
        $this->_set_data('alerts', $alerts);
    }

    private function load_application(){
        $application_data = $this->application_model->get();
        $this->_set_data('application', $application_data);
    }

    public function _get_data($key=FALSE){
        if(!$key){
            return $this->data;
        }
        return $this->data[$key];
    }

    public function _set_data($key, $value){
        $this->data[$key] = $value;
    }
}
