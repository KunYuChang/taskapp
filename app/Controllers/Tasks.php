<?php

namespace App\Controllers;

class Tasks extends BaseController
{
    public function index()
    {
        $model = new \App\Models\TaskModel;
        $data = $model->findAll();

        return view('Tasks/index.php',['tasks'=>$data]);
    }

    public function show($id)
    {
        $model = new \App\Models\TaskModel;
        $task = $model->find($id);

        return view('Tasks/show.php',['task'=>$task]);
    }

    public function new()
    {
        return view('Tasks/new.php');
    }

    public function create()
    {
        $model = new \App\Models\TaskModel;

        // Inserts data and returns inserted row's primary key on success and false on failure
        $result = $model->insert([
            'description' => $this->request->getPost("description")
        ],true);

        if ($result === false) {

            // CI 官方 : 一般來說，使用全局變量是不好的做法。所以$_SESSION不推薦直接使用超全局。
            // $_SESSION['erros'] = $model->errors();

            // CI 會自動建立 session 來傳遞資料
            return redirect()->back()
                             // Set a flash message
                             ->with('errors', $model->errors())
                             // Set a flash message
                             ->with('warning', 'Invalid data');
        } else {
            return redirect()->to("/tasks/show/$result")
                             // Set a flash message
                             ->with('info', 'Task created successfully');
        }
    }

    public function edit($id)
    {
        $model = new \App\Models\TaskModel;
        $task = $model->find($id);

        return view('Tasks/edit.php',['task'=>$task]);
    }
}
