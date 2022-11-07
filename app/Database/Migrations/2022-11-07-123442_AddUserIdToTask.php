<?php

// php spark migrate:create add_user_id_to_task

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToTask extends Migration
{
    public function up()
    {
        // https://codeigniter.com/user_guide/dbmgmt/forge.html#id1
        $sql = "ALTER TABLE task ADD user_id INT";
        $this->db->query($sql);

        $sql = "ALTER TABLE task
                ADD CONSTRAINT task_user_id_fk
				FOREIGN KEY (user_id) REFERENCES user(id)
				ON DELETE CASCADE ON UPDATE CASCADE";
        $this->db->query($sql);
    }

    public function down()
    {
        // https://codeigniter.com/user_guide/dbmgmt/forge.html#dropping-a-foreign-key
        $this->forge->dropForeignKey('task', 'task_user_id_fk');
        $this->forge->dropColumn('task', 'user_id');
    }
}
