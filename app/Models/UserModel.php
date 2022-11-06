<?php

namespace App\Models;

class UserModel extends \CodeIgniter\Model
{
    // (1) Model 對應到的 Table
    protected $table = 'user';

    // (2) 設定這個 Table 允許被寫入的欄位 (CI預設不給寫入)
    protected $allowedFields = ['name', 'email'];

    // (3) https://codeigniter.com/user_guide/models/entities.html
    protected $returnType = 'App\Entities\Task';

    // https://codeigniter.com/user_guide/models/model.html#usetimestamps
    protected $useTimestamps = true;
}