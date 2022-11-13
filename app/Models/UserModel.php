<?php

namespace App\Models;

class UserModel extends \CodeIgniter\Model
{
    // (1) Model 對應到的 Table
    protected $table = 'user';

    // (2) 設定這個 Table 允許被寫入的欄位 (CI預設不給寫入)
    protected $allowedFields = ['name', 'email', 'password'];

    // (3) https://codeigniter.com/user_guide/models/entities.html
    protected $returnType = 'App\Entities\Task';

    // https://codeigniter.com/user_guide/models/model.html#usetimestamps
    protected $useTimestamps = true;

    // https://codeigniter.com/user_guide/libraries/validation.html#available-rules
    protected $validationRules = [
        'name' => 'required',
        'email' => 'required|valid_email|is_unique[user.email]',
        'password' => 'required|min_length[6]',
        'password_confirmation' => 'required|matches[password]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => '信箱已被註冊。'
        ],
        'password_confirmation' => [
            'required' => '請輸入密碼!',
            'matches' => '輸入的密碼不一致，請重新輸入。'
        ]
    ];

    // https://codeigniter.com/user_guide/models/model.html#model-events
    protected $beforeInsert = ['hashPassword'];

    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            // https://www.php.net/manual/en/function.password-hash.php
            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

            unset($data['data']['password']);
        }
        return $data;
    }

    // https://codeigniter.com/user_guide/database/query_builder.html
    public function findByEmail($email)
    {
        return $this->where('email', $email)
            ->first();
    }

    public function disablePasswordValidation()
    {
        unset($this->validationRules['password']);
        unset($this->validationRules['password_confirmation']);
    }
}

