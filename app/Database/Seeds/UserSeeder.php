<?php

// php spark make:seeder UserSeeder
// php spark db:seed UserSeeder
// https://codeigniter.com/user_guide/dbmgmt/migration.html

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = new \App\Models\UserModel;

        $data = [
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'secret',
            'is_admin' => true,
            'is_active' => true
        ];

        /**
         * skipValidation : 是否暫時跳過 Model $validationRules,
         *                  這邊要跳過的原因是因為要跳過password_confirmation的驗證
         *                  因為並沒有給password_confirmation
         * protect : Model $allowedFields 是否保護? (false則暫時取消保護)
         *           這邊取消保護的原因是要插入的is_admin欄位並沒有被設置在$allowedFields當中
         *
         */
        $model->skipValidation(true)
            ->protect(false)
            ->insert($data);
    }
}
