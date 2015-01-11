<?php

class Migration_Add_Logins extends CI_Migration{
    
    public $tablename = 'logins';

    public function up(){
        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 10,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE,
                ],
                'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
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
