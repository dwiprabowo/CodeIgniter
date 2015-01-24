<?php

class Email_model extends Entity_model{

    public $form = [
        'default' => 'front',
        'template' => 'simple',
        'items' => [
            'front' => [
                'fields' => [
                    'email' => [
                        'type' => INPUT_TYPE_TEXT,
                        'rules' => 'required|valid_email|is_unique[emails.email]',
                    ]
                ]
            ]
        ]
    ];

}