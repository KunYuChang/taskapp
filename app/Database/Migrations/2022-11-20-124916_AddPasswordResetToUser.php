<?php

// php spark migrate:create add_password_reset_to_user
// php spark migrate

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordResetToUser extends Migration
{
    public function up()
    {
        $this->forge->addColumn('user', [
            'reset_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '64',
                'nuique' => true
            ],
            'reset_expires_at' => [
                'type' => 'DATETIME'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('user', 'reset_expire_at');
        $this->forge->dropColumn('user', 'reset_hash');
    }
}
