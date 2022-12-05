<?php

namespace App\Libraries;

use App\Models\UserModel;

class Authentication
{
    // 通過快取使用者記錄避免多次相同的資料庫查詢
    private $user;

    public function login($email, $password, $remember_me)
    {
        $model = new UserModel;

        $user = $model->findByEmail($email);

        if ($user === null) {
            return false;
        }

        // https://www.php.net/manual/en/function.password-verify.php
        if (!password_verify($password, $user->password_hash)) {
            return false;
        }

        // 帳號是否激活
        if (!$user->is_active) {
            return false;
        }

        $session = session();
        $session->regenerate(); // 保護 session fixation
        $session->set('user_id', $user->id);

        if($remember_me) {
            $this->rememberLogin($user->id);
        }

        return true;
    }

    // 記住登入者
    private function rememberLogin($user_id) {
        $model = new \App\Models\RememberedLoginModel;

        [$token, $expiry] = $model->rememberUserLogin($user_id);

        $response = service('response');

        $response->setCookie('remember_me', $token, $expiry);
    }

    public function logout()
    {
        session()->destroy();
    }

    public function getCurrentUser()
    {
        if (!session()->has('user_id')) {
            return null;
        }

        if ($this->user === null) {
            $model = new UserModel;

            $user = $model->find(session()->get('user_id'));

            if ($user && $user->is_active) {
                $this->user = $user;
            }
        }

        return $this->user;
    }

    public function isLoggedIn()
    {
        return $this->getCurrentUser() !== null;
    }
}