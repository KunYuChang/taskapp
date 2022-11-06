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

    // https://codeigniter.com/user_guide/models/model.html#model-events
    protected $beforeInsert = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if(isset($data['data']['password'])) {
            // https://www.php.net/manual/en/function.password-hash.php
            $data['data']['password_hash'] = password_hash($data['data']['password'],PASSWORD_DEFAULT);

            unset($data['data']['password']);
        }
        return $data;
    }
}