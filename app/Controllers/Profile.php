<?php

namespace App\Controllers;

use SebastianBergmann\CodeCoverage\Report\PHP;

class Profile extends BaseController
{
    private $user;

    public function __construct()
    {
        $this->user = service('auth')->getCurrentUser();
    }

    public function show()
    {
        return view('Profile/show', [
            'user' => $this->user
        ]);
    }

    public function edit()
    {
        $session = session();

        if (!$session->has('can_edit_profile_until')) {
            return redirect()->to('/profile/authenticate');
        }

        if ($session->get('can_edit_profile_until') < time()) {
            return redirect()->to('/profile/authenticate');
        }

        return view('Profile/edit', [
            'user' => $this->user
        ]);
    }

    public function update()
    {
        $this->user->fill($this->request->getPost());

        if (!$this->user->hasChanged()) {

            return redirect()->back()
                ->with('warning', 'Nothing to update')
                ->withInput();
        }

        $model = new \App\Models\UserModel;

        if ($model->save($this->user)) {

            session()->remove('can_edit_profile_until');

            return redirect()->to("/profile/show")
                ->with('info', 'Details updated successfully');

        } else {

            return redirect()->back()
                ->with('errors', $model->errors())
                ->with('warning', 'Invalid data')
                ->withInput();
        }
    }

    public function editPassword()
    {
        return view('Profile/edit_password');
    }

    public function updatePassword()
    {
        $current_passowrd = $this->request->getPost('current_password');

        $verify = password_verify($current_passowrd, $this->user->password_hash);

        if (!$verify) {
            return redirect()->back()
                ->with('warning', 'Invalid current password');
        }

        $this->user->fill($this->request->getPost());

        $model = new \App\Models\UserModel;

        if ($model->save($this->user)) {

            return redirect()->to("/profile/show")
                ->with('info', 'Password updated successfully');
        } else {

            return redirect()->back()
                ->with('errors', $model->errors())
                ->with('warning', 'Invalid data');
        }
    }

    public function authenticate()
    {
        return view('Profile/authenticate');
    }

    public function processAuthenticate()
    {
        $current_passowrd = $this->request->getPost('password');
        $verify = password_verify($current_passowrd, $this->user->password_hash);

        if ($verify) {

            // 有五分鐘時間可以修改資料
            session()->set('can_edit_profile_until', time() + 300);

            return redirect()->to('/profile/edit');
        } else {

            return redirect()->back()
                ->with('warning', 'Invalid password');
        }
    }

    public function image()
    {
        if ($this->user->profile_image) {
            $path = WRITEPATH. 'uploads/profile_images/' . $this->user->profile_image;

            // https://www.php.net/manual/en/class.finfo.php
            $finfo = new \finfo(FILEINFO_MIME);

            $type = $finfo->file($path);

            header("Content-Type: $type");
            header("Content-Length: ". filesize($path));

            // https://www.php.net/manual/en/function.readfile.php
            readfile($path);
            exit;
        }
    }
}