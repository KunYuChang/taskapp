<?php

namespace App\Models;

class TaskModel extends \CodeIgniter\Model
{
    // Model 對應到的 Table
    protected $table = 'task';

    // 設定這個 Table 允許被寫入的欄位 (CI預設不給寫入)
    protected $allowedFields = ['description'];

    protected $returnType = 'App\Entities\Task';
//    protected $returnType = 'object';

    protected $validationRules = [
        'description' => 'required'
    ];

    protected $validationMessages = [
        'description' => [
            'required' => '請輸入任務描述!'
        ]
    ];
}