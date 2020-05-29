<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;

class WebAuthPageController extends Controller
{
    public function displayLoginPage()
    {
        return view('auth.login');
    }

    public function displaySignupPage()
    {
        return view('auth.signup');
    }
}
