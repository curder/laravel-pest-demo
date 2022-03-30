<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class BookCreateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(): View
    {
        return view('books.create');
    }
}
