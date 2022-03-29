<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class RegisterIndexController extends Controller
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        return view('auth.register');
    }
}
