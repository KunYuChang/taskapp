<?php

namespace App\Controllers;

use App\Entities\User;
use App\Models\UserModel;

class Signup extends BaseController
{
    public function new()
    {
        return view("Signup/new");
    }

    public function create()
    {
        $user = new User($this->request->getPost());
        $model = new UserModel;

        $token = bin2hex(random_bytes(16));

        // 密碼產生器 : https://randomkeygen.com/
        $hash = hash_hmac('sha256', $token, $_ENV['HASH_SECRET_KEY']);

        $user->activation_hash = $hash;

        if ($model->insert($user)) {
            return redirect()->to("/signup/success");
        } else {
            return redirect()->back()
                ->with('errors', $model->errors())
                ->with('warning', 'Invalid data')
                ->withInput();
        }
    }

    public function success()
    {
        return view('Signup/success');
    }
}