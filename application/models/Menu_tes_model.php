<?php

class Menu_tes_model extends Menu_model{

    function set_menu(){
        return [
            'tes' => [
                'label' => 'tes',
                'action' => 'tes',
                'active' => [
                    'tes'
                ]
            ]
        ];
    }

}