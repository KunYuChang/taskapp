<?php

namespace App\Controllers;

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

        $auth = new \App\Libraries\Authentication;

        if ($auth->login($email, $password)) {
            return redirect()->to("/")
                ->with("info", "Login successful");
        } else {
            return redirect()->back()
                ->withInput()
                ->with('warning', 'Invalid login');
        }
    }

    public function delete()
    {
        $auth = new \App\Libraries\Authentication;
        $auth->logout();

        // session destroy 之後 ,這邊將無法傳送 flash message
        return redirect()->to('/login/showLogoutMessage');
    }

    // 因為 delete() session destroy, 因此我們透過新的請求, 啟用新的session 才可以傳送 flash message
    public function showLogoutMessage()
    {
        return redirect()->to('/')
            ->with('info', 'Logout successful');
    }
}