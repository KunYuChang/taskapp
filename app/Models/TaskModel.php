<?php

namespace App\Models;

class TaskModel extends \CodeIgniter\Model
{
    // Model 對應到的 Table
    protected $table = 'task';

    // 設定這個 Table 允許被寫入的欄位 (CI預設不給寫入)
    protected $allowedFields = ['description', 'user_id'];

    // https://codeigniter.com/user_guide/models/entities.html
    protected $returnType = 'App\Entities\Task';
    // protected $returnType = 'object';

    // https://codeigniter.com/user_guide/models/model.html#usetimestamps
    // 自動寫入created_at, updated_at
    protected $useTimestamps = true;

    protected $validationRules = [
        'description' => 'required'
    ];

    protected $validationMessages = [
        'description' => [
            'required' => '請輸入任務描述!'
        ]
    ];

    public function paginateTasksByUserId($id)
    {
        // https://codeigniter.com/user_guide/database/query_builder.html#orderBy
        return $this->where('user_id', $id)
            ->orderBy('created_at', 'DESC')
            ->paginate(3);
    }

    public function getTaskByUserId($id, $user_id)
    {
        return $this->where('id', $id)
            ->where('user_id', $user_id)
            ->first();
    }
}