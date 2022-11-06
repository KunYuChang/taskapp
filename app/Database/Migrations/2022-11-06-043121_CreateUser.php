<?php

// php spark migrate:create create_user
// php spark migrate
// php spark migrate:rollback

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUser extends Migration
{
    protected $db;

    public function __destruct()
    {
        $this->db = db_connect();
    }

    public function up()
    {
        // https://www.php.net/manual/en/function.password-hash.php
        $sql = "CREATE TABLE user(
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    name VARCHAR(128),
                    email VARCHAR(255) NOT NULL UNIQUE,
                    password_hash VARCHAR(255),
                    created_at DATETIME, 
                    updated_at DATETIME
                )";
        $this->db->query($sql);
    }

    public function down()
    {
        $db = db_connect();
        $sql = "DROP TABLE user";
        $this->db->query($sql);
    }
}
