<?php

class Menu_Model extends CI_Model{
    protected $plural_name = 'menu';
    protected $singular_name = 'menu';

    private $menu_format = [
    	'glyphicon' => "minus",
    	'label' => "undefined",
    	'is_dropdown' => FALSE,
    	'action' => "#",
    	'active' => FALSE,
    ];

	protected $menu = [
		'user' => [
			'glyphicon' => 'user',
			'label' => 'User',
			'action' => 'user',
			'active_in' => [
				'user'
			]
		],
		'spk' => [
			'glyphicon' => 'file',
			'label' => 'SPK',
		],
		'stock' => [
			'glyphicon' => 'shopping-cart',
			'label' => 'Stock',
		],
		'do' => [
			'glyphicon' => 'send',
			'label' => 'DO',
		],
		'sales' => [
			'glyphicon' => 'usd',
			'label' => 'Sales',
		],
		'stnk' => [
			'glyphicon' => 'modal-window',
			'label' => 'STNK',
		],
		'bpkb' => [
			'glyphicon' => 'modal-window',
			'label' => 'BPKB',
		],
	];

	function __construct(){
		parent::__construct();
		$this->init_menu();
	}

	private function init_menu(){
		foreach($this->menu as $k => $v){
			$this->add($k, $v);
		}
	}

	public function actives($keys){
		if(!$keys){
			return;
		}
		foreach ($this->menu as $k => $v){
			if(in_array($k, $keys))
			$this->menu[$k]['active'] = TRUE;
		}
	}

	public function get(){
		return $this->menu;
	}

	public function add($key, $data){
		$data = array_replace_recursive($this->menu_format, $data);
		$this->menu[strtolower($key)] = $data;
	}
}
