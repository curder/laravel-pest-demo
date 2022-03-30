<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookEditController extends Controller
{
    public function __invoke(Book $book, Request $request): View
    {
        $this->authorize('update', $book);

        // @phpstan-ignore-next-line
        $book = $request->user()->books()->find($book->id);

        return view('books.edit', compact('book'));
    }
}
