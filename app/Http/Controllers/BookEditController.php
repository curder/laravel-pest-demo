<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookEditController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Book $book, Request $request): View
    {
        if (!$book = $request->user()->books->find($book->id)) {
            abort(403);
        }

        return view('books.edit', compact('book'));
    }
}
