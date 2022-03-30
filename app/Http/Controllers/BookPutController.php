<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookPutRequest;
use Illuminate\Routing\Redirector;

class BookPutController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Book $book, BookPutRequest $request): Redirector
    {
        $book->update($request->only(['title', 'author'])); // 更新books

        $request->user()->books()->updateExistingPivot($book, [
            'status' => $request->get('status')
        ]); // 更新关联表

        return redirect('/');
    }
}
