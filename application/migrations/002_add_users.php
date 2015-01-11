<?php

class Migration_Add_Users extends CI_Migration{
    
    public $tablename = 'users';

    public function up(){
        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 10,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE,
                ],
                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
                'username' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
                'login_id' => [
                    'type' => 'INT',
                    'constraint' => 10,
                    'unsigned' => TRUE,
                ],
                'administration_id' => [
                    'type' => 'INT',
                    'constraint' => 10,
                    'unsigned' => TRUE,
                ]
            ]
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->tablename);
        $this->db->query("
            ALTER TABLE $this->tablename
            ADD UNIQUE INDEX (`username`)
        ");
    }

    public function down(){
        $this->dbforge->drop_table($this->tablename);
    }
}
