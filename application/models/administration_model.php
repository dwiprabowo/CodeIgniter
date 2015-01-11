<?php
class Administration_Model extends MY_Model{

	protected $plural_name = 'administrations';
	protected $singular_name = 'administration';

	protected $belongs_to = [
		'user'
	];
	
}