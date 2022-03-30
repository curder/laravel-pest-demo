<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function __invoke()
    {
        return view('auth.login');
    }
}
