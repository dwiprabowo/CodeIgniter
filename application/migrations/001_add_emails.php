<?php

class Migration_add_emails extends MY_Migration{

    public $fields = [
        'email' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
        ]
    ];
    
}