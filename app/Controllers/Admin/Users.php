<?php

namespace App\Controllers\Admin;

// extends BaseController, namespace 要給全稱 (因為在不同的namespace底下)

use App\Entities\User;

class Users extends \App\Controllers\BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new \App\Models\UserModel;
    }

    public function index()
    {
        $users = $this->model->orderBy('id')
            ->paginate(5);

        return view('Admin/Users/index', [
            'users' => $users,
            'pager' => $this->model->pager
        ]);
    }

    public function show($id)
    {
        $user = $this->getUserOr404($id);

        return view('Admin/Users/show.php', [
            'user' => $user
        ]);
    }

    public function new()
    {
        $user = new User;

        return view('Admin/Users/new', [
            'user' => $user
        ]);
    }

    public function create()
    {
        // 取得使用者傳送過來的資料
        $user = new User($this->request->getPost());

        if ($this->model->protect(false)->insert($user)) {
            return redirect()->to("/admin/users/show/{$this->model->insertID}")
                // Set a flash message
                ->with('info', 'User created successfully');

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
        $user = $this->getUserOr404($id);

        return view('Admin/Users/edit.php', [
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $user = $this->getUserOr404($id);

        $post = $this->request->getPost();


        if (empty($post['password'])) {
            $this->model->disablePasswordValidation();

            unset($post['password']);
            unset($post['password_confirmation']);
        }

        // https://codeigniter.com/user_guide/models/entities.html#filling-properties-quickly
        $user->fill($post);

        // https://codeigniter.com/user_guide/models/entities.html#checking-for-changed-attributes
        if (!$user->hasChanged()) {
            return redirect()->back()
                ->with('warning', 'Nothing to update')
                ->withInput();
        }

        // https://codeigniter.com/user_guide/models/model.html#save

        if ($this->model
            ->protect(false)
            ->save($user)) {

            return redirect()->to("/admin/users/show/$id")
                ->with('info', 'User updated successfully');

        } else {

            return redirect()->back()
                ->with('erros', $this->model->errors())
                ->with('warning', 'Invalid data')
                ->withInput();

        }
    }

    public function delete($id)
    {
        $user = $this->getUserOr404($id);

        // https://codeigniter4.github.io/userguide/incoming/incomingrequest.html#determining-request-type
        if ($this->request->getMethod() === 'post') {
            $this->model->delete($id);

            return redirect()->to('/admin/users')
                ->with('info', 'User deleted');
        }

        return view('Admin/Users/delete', [
            'user' => $user
        ]);
    }

    private function getUserOr404($id)
    {
        $user = $this->model->where('id', $id)
            ->first();

        if ($user === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("找不到編號 $id 的使用者");
        }

        return $user;
    }

}