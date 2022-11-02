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

        $result = $model->insert([
            'description' => $this->request->getPost("description")
        ]);

        if ($result === false) {
            dd($model->errors());
        } else {
            dd($result);
        }
    }
}
