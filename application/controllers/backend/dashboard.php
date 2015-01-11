<?php

class Dashboard extends MY_Controller{
    protected $models = [
        "temp",
        "application",
    ];

    protected $container_menus = [
        "overview" => [
            "label" => "Overview",
            "action" => "backend/dashboard",
            "active_in" => [
                "backend/dashboard/index"
            ]
        ],
        "Application" => [
            "label" => "Application",
            "action" => "backend/dashboard/application",
            "active_in" => [
                "backend/dashboard/application"
            ]
        ],
        "Menu" => [
            "label" => "Menu",
            "action" => "backend/dashboard/menu",
            "active_in" => [
                "backend/dashboard/menu"
            ]
        ]
    ];

    function __construct(){
        parent::__construct();
        $this->bootstrap->set_navbar(Bootstrap::NAVBAR_INVERSE);
        $this->bootstrap->set_container(Bootstrap::CONTAINER_DASHBOARD);
        $this->_add_menu(
            [
                'user' => [
                    'label' => 'User',
                    'is_dropdown' => TRUE,
                    'menus' => [
                        'logout' => [
                            'label' => 'Logout',
                            'action' => 'backend/logout'
                        ]
                    ]
                ]
            ]
        );
        if(!$this->temp_model->login()){
            $this->alert->error('Please sign in!');
            redirect($this->directory);
        }
    }

    public function index(){}

    public function application_get(){}

    public function application_post($data){
        $result = $this->application_model->insert($data);
        if($result){
            $this->alert->success('Data updated successfully!');
            redirect('backend/dashboard');
        }else{
            $this->alert->error('Error while updating data!');
            redirect('backend/dashboard/application');
        }
    }

    public function menu_get(){}

    public function menu_post($data){
        d($data);
        die;
    }
}
