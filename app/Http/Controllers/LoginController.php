<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function __invoke(): View
    {
        return view('auth.login');
    }
}
