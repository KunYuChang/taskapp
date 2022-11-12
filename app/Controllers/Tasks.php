<?php

namespace App\Controllers;

use App\Entities\Task;

class Tasks extends BaseController
{
    private \App\Models\TaskModel $model;
    private $current_user;

    public function __construct()
    {
        $this->model = new \App\Models\TaskModel;
        $this->current_user = service('auth')->getCurrentUser();
    }

    public function index()
    {
        $data = $this->model->paginateTasksByUserId($this->current_user->id);

        return view("Tasks/index", [
            'tasks' => $data,
            'pager' => $this->model->pager
        ]);
    }

    public function show($id)
    {
        $task = $this->getTaskOr404($id);

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
        // 取得使用者傳送過來的資料
        $task = new Task($this->request->getPost());

        // 資料加上身份
        $task->user_id = $this->current_user->id;

        if ($this->model->insert($task)) {
            return redirect()->to("/tasks/show/{$this->model->insertID}")
                // Set a flash message
                ->with('info', 'Task created successfully');

        } else {
            // CI 官方 : 一般來說，使用全局變量是不好的做法。所以$_SESSION不推薦直接使用超全局。
            // $_SESSION['erros'] = $model->errors();

            // CI 會自動建立 session 來傳遞資料
            return redirect()->back()
                // Set a flash message
                ->with('errors', $this->model->errors())
                // Set a flash message
                ->with('warning', 'Invalid data')
                ->withInput();
        }
    }

    public function edit($id)
    {
        $task = $this->getTaskOr404($id);

        return view('Tasks/edit.php', ['task' => $task]);
    }

    public function update($id)
    {
        $task = $this->getTaskOr404($id);

        $post = $this->request->getPost();

        // 更新資料時不更新使用者id
        unset($post['user_id']);

        // https://codeigniter.com/user_guide/models/entities.html#filling-properties-quickly
        $task->fill($this->request->getPost());

        // https://codeigniter.com/user_guide/models/entities.html#checking-for-changed-attributes
        if (!$task->hasChanged()) {
            return redirect()->back()
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

    public function delete($id)
    {
        $task = $this->getTaskOr404($id);

        // https://codeigniter4.github.io/userguide/incoming/incomingrequest.html#determining-request-type
        if ($this->request->getMethod() === 'post') {
            $this->model->delete($id);

            return redirect()->to('/tasks')
                ->with('info', 'Task deleted');
        }

        return view('Tasks/delete', [
            'task' => $task
        ]);
    }

    private function getTaskOr404($id)
    {
//        $task = $this->model->find($id);

        // 找不到就是不能看
        $task = $this->model->getTaskByUserId($id, $this->current_user->id);

        // https://codeigniter.com/user_guide/general/errors.html#pagenotfoundexception
        if ($task === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("找不到編號 $id 的任務ID");
        }

        return $task;
    }
}
