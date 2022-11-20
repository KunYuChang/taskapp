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

            $this->sendResetEmail($user);

            return redirect()->to("/password/resetsent");

        } else {
            return redirect()->back()
                ->with('warning', '沒有符合此信箱之有效帳號')
                ->withInput();
        }
    }

    public function resetSent()
    {
        return view('Password/reset_sent');
    }

    public function reset($token)
    {
        $model = new \App\Models\UserModel;

        $user = $model->getUserForPasswordReset($token);

        if ($user) {
            return view('Password/reset', [
                'token' => $token
            ]);
        } else {
            return redirect()->to('/password/forgot')
                ->with('warning', 'Link invalid or has expired. Please try again');
        }
    }

    public function processReset($token)
    {
        $model = new \App\Models\UserModel;

        $user = $model->getUserForPasswordReset($token);

        if ($user) {

            $user->fill($this->request->getPost());

            if ($model->save($user)) {

                $user->completePasswordReset();
                $model->save($user);
                return redirect()->to('/password/resetsuccess');

            } else {
                return redirect()->back()
                    ->with('errors', $model->errors())
                    ->with('warning', 'Invalid data');
            }

        } else {
            return redirect()->to('/password/forgot')
                ->with('warning', 'Link invalid or has expired. Please try again');
        }
    }

    public function resetSuccess()
    {
        return view('Password/reset_success');
    }

    private function sendResetEmail($user)
    {
        $email = service('email');

        $email->setTo($user->email);

        $email->setSubject('密碼重置');

        $message = view('Password/reset_email', [
            'token' => $user->reset_token
        ]);

        $email->setMessage($message);

        $email->send();
    }
}