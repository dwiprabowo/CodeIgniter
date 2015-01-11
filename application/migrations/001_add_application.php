<?php

class Migration_Add_Application extends CI_Migration{

    public $tablename = 'application';

    public function up(){
        $this->dbforge->add_field(
            [
                'data' => [
                    'type' => 'TEXT'
                ]
            ]
        );
        $this->dbforge->create_table($this->tablename);
    }

    public function down(){
        $this->dbforge->drop_table($this->tablename);
    }
}
