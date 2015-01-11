<?php

class Migration_Add_Administrations extends CI_Migration{

	public $tablename = 'administrations';

	public function up(){
		$this->dbforge->add_field(
			[
				'id' => [
					'type' => 'INT',
					'constraint' => 10,
					'unsigned' => TRUE,
					'auto_increment' => TRUE,
				],
				'data' => [
					'type' => 'VARCHAR',
					'constraint' => 255
				],
				'is_active' => [
					'type' => 'TINYINT',
					'constraint' => 1,
					'unsigned' => TRUE,
					'default' => 0
				]
			]
		);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($this->tablename);
	}

	public function down(){
		$this->dbforge->drop_table($this->tablename);
	}
}