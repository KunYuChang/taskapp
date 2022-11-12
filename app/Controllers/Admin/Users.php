<?php

namespace App\Controllers\Admin;

// extends BaseController, namespace 要給全稱 (因為在不同的namespace底下)
class Users extends \App\Controllers\BaseController
{
    public function index()
    {
        return view('Admin/Users/index');
    }
}