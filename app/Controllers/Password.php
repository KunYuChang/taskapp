<?php

namespace App\Controllers;

class Password extends BaseController
{
    public function forgot()
    {
        return view('Password/forgot');
    }

    public function processForgot()
    {
        $model = new \App\Models\UserModel;

        $email = $this->request->getPost('email');

        $user = $model->findByEmail($email);

        if ($user && $user->is_active) {

            $user->startPasswordReset();
            $model->save($user);

        } else {
            return redirect()->back()
                ->with('warning', '沒有符合此信箱之有效帳號')
                ->withInput();
        }
    }
}