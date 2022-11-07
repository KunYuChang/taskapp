<?php

// xxx_helper.php 的命名方式 CI才可以自動載入

if (!function_exists('current_user')) {
    function current_user()
    {
        $auth = new \App\Libraries\Authentication;

        return $auth->getCurrentUser();
    }
}