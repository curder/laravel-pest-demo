<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @param Request  $request
     *
     * @return View
     */
    public function __invoke(Request $request): View
    {
        $books_by_status = $request->user()?->books->groupBy('pivot.status');

        return view('home', compact('books_by_status'));
    }
}
