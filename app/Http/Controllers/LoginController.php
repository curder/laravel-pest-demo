<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class LoginController extends Controller
{
    public function __invoke(): View
    {
        return view('auth.login');
    }
}
