<?php

namespace App\Controllers;

use App\Entities\Task;

class Tasks extends BaseController
{
    public function index()
    {
        $model = new \App\Models\TaskModel;
        $data = $model->findAll();

        return view('Tasks/index.php', ['tasks' => $data]);
    }

    public function show($id)
    {
        $model = new \App\Models\TaskModel;
        $task = $model->find($id);

        return view('Tasks/show.php', ['task' => $task]);
    }

    public function new()
    {
        $task = new Task;
        return view('Tasks/new.php', [
            'task' => $task
        ]);
    }

    public function create()
    {
        $model = new \App\Models\TaskModel;

        $task = new Task($this->request->getPost());

        if ($model->insert($task)) {
            return redirect()->to("/tasks/show/{$model->insertID}")
                // Set a flash message
                ->with('info', 'Task created successfully');

        } else {
            // CI 官方 : 一般來說，使用全局變量是不好的做法。所以$_SESSION不推薦直接使用超全局。
            // $_SESSION['erros'] = $model->errors();

            // CI 會自動建立 session 來傳遞資料
            return redirect()->back()
                // Set a flash message
                ->with('errors', $model->errors())
                // Set a flash message
                ->with('warning', 'Invalid data')
                ->withInput();
        }
    }

    public function edit($id)
    {
        $model = new \App\Models\TaskModel;
        $task = $model->find($id);

        return view('Tasks/edit.php', ['task' => $task]);
    }

    public function update($id)
    {
        $model = new \App\Models\TaskModel;

        // https://codeigniter.com/user_guide/models/entities.html#filling-properties-quickly
        $task = $model->find($id);
        $task->fill($this->request->getPost());

        // https://codeigniter.com/user_guide/models/entities.html#checking-for-changed-attributes
        if (! $task->hasChanged()) {
            return  redirect()->back()
                              ->with('warning', 'Nothing to update')
                              ->withInput();
        }

        // https://codeigniter.com/user_guide/models/model.html#save
        if ($model->save($task)) {
            return redirect()->to("/tasks/show/$id")
                ->with('info', 'Task updated successfully');
        } else {
            return redirect()->back()
                ->with('erros', $model->errors())
                ->with('warning', 'Invalid data')
                ->withInput();
        }
    }
}
