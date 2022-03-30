<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookPutRequest;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;

class BookPutController extends Controller
{
    public function __invoke(Book $book, BookPutRequest $request): RedirectResponse
    {
        $book->update($request->only(['title', 'author'])); // 更新books

        // @phpstan-ignore-next-line
        $request->user()->books()->updateExistingPivot($book, [
            'status' => $request->get('status'),
        ]); // 更新关联表

        return redirect('/');
    }
}
