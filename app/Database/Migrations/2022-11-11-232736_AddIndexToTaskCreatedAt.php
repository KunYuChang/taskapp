<?php

// php spark migrate:create add_index_to_task_created_at
// php spark migrate

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIndexToTaskCreatedAt extends Migration
{
    public function up()
    {
        $this->db->simpleQuery("ALTER TABLE task ADD INDEX (created_at)");
    }

    public function down()
    {
        $this->db->simpleQuery("ALTER TABLE task DROP INDEX (created_at)");
    }
}
