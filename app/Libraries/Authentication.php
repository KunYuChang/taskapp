<?php

namespace App\Libraries;

use App\Models\UserModel;

class Authentication
{
    // 通過快取使用者記錄避免多次相同的資料庫查詢
    private $user;

    public function login($email, $password)
    {
        $model = new UserModel;

        $user = $model->findByEmail($email);

        if ($user === null) {
            return false;
        }

        // https://www.php.net/manual/en/function.password-verify.php
        if (! $user->verifyPassword($password)) {
            return false;
        }

        $session = session();
        // 登入時重新產生session : prevent session fixation attacks
        $session->regenerate();
        $session->set('user_id', $user->id);

        return true;
    }

    public function logout()
    {
        session()->destroy();
    }

    public function getCurrentUser()
    {
        if (! session()->has('user_id')) {
            return null;
        }

        if ($this->user === null) {
            $model = new UserModel;
            $this->user = $model->find(session()->get('user_id'));
        }

        return $this->user;
    }
}