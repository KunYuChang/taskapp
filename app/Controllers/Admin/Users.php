<?php

namespace App\Controllers\Admin;

// extends BaseController, namespace 要給全稱 (因為在不同的namespace底下)
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