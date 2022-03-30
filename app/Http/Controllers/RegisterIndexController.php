<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class RegisterIndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    /**
     * @return View
     */
    public function __invoke(): View
    {
        return view('auth.register');
    }
}
