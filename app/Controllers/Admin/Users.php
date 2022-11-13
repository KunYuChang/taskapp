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

        if ($this->model->insert($user)) {
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