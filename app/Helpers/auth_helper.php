<?php

// xxx_helper.php 的命名方式 CI才可以自動載入

if (!function_exists('current_user')) {
    function current_user()
    {
        if (!session()->has('user_id')) {
            return null;
        }

        $model = new \App\Models\UserModel;

        return $model->find(session()->get('user_id'));
    }
}