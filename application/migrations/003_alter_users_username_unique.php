<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_users_username_unique extends CI_Migration {
    private $tablename = "users";
    private $field_name = "username";

    public function __construct() {
        parent::__construct();
    }

    public function up() {
        $this->db->query(create_index_query($this->tablename, $this->field_name, [$this->field_name], 'UNIQUE'));
    }

    public function down() {
        $this->db->query(drop_index_query($this->tablename, $this->field_name."_INDEX"));
    }
}