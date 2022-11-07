<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function new()
    {
        return view("Login/new");
    }

    public function create()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $model = new UserModel;

        // https://codeigniter.com/user_guide/database/query_builder.html
        $user = $model->where('email', $email)
            ->first();

        if ($user === null) {
            return redirect()->back()
                ->withInput()
                ->with('warning', 'User not found');
        }

        // https://www.php.net/manual/en/function.password-verify.php
        if (!password_verify($password, $user->password_hash)) {

            return redirect()->back()
                ->withInput()
                ->with('warning', 'Incorrect password');
        }

        $session = session();
        // 登入時重新產生session : prevent session fixation attacks
        $session->regenerate();
        $session->set('user_id', $user->id);

        return redirect()->to("/")
                         ->with("info", "Login successful");
    }
}