<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

// https://codeigniter.com/user_guide/incoming/filters.html
class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!service('auth')->isLoggedIn()) {

            // https://codeigniter.com/user_guide/helpers/url_helper.html#current_url
            session()->set('redirect_url', current_url());

            return redirect()->to('/login')
                ->with('info', '請先登入!');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}