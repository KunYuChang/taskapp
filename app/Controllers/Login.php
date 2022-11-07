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

        // https://codeigniter.com/user_guide/concepts/services.html
        $auth = service('auth');

        if ($auth->login($email, $password)) {

            $redirect_url = session('redirect_url') ?? '/';

            unset($_SESSION['redirect_url']);

            return redirect()->to($redirect_url)
                ->with("info", "Login successful");

        } else {

            return redirect()->back()
                ->withInput()
                ->with('warning', 'Invalid login');

        }
    }

    public function delete()
    {
        service('auth')->logout();

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