<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Task extends Seeder
{
    public function run()
    {
        $data = [
            [
                'description' => 'task 1'
            ],
            [
                'description' => 'task 2'
            ]
        ];

        $this->db->table('task')->insertBatch($data);
    }
}
