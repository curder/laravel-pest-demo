<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;

class BookStoreController extends Controller
{
    public function __invoke(BookStoreRequest $request): RedirectResponse
    {
        $book = Book::query()->create($request->only(['title', 'author']));

        // @phpstan-ignore-next-line
        $request->user()->books()->attach($book, [
            'status' => $request->get('status'),
        ]);

        return redirect('/');
    }
}
