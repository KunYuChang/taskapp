<?php

namespace App\Controllers;

use App\Entities\Task;

class Tasks extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new \App\Models\TaskModel;
    }


    public function index()
    {
        $data = $this->model->findAll();

        return view("Tasks/index", ['tasks' => $data]);
    }

    public function show($id)
    {
        $task = $this->model->find($id);

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
        $task = new Task($this->request->getPost());

        if ($this->model->insert($task)) {
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
        $task = $this->model->find($id);

        return view('Tasks/edit.php', ['task' => $task]);
    }

    public function update($id)
    {
        // https://codeigniter.com/user_guide/models/entities.html#filling-properties-quickly
        $task = $this->model->find($id);
        $task->fill($this->request->getPost());

        // https://codeigniter.com/user_guide/models/entities.html#checking-for-changed-attributes
        if (! $task->hasChanged()) {
            return  redirect()->back()
                              ->with('warning', 'Nothing to update')
                              ->withInput();
        }

        // https://codeigniter.com/user_guide/models/model.html#save
        if ($this->model->save($task)) {
            return redirect()->to("/tasks/show/$id")
                ->with('info', 'Task updated successfully');
        } else {
            return redirect()->back()
                ->with('erros', $this->model->errors())
                ->with('warning', 'Invalid data')
                ->withInput();
        }
    }
}
