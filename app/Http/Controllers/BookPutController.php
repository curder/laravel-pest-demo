<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Pivot\BookUser;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Redirector;

class BookPutController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Book $book, Request $request): Redirector
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'status' => [
                'required',
                Rule::in(array_keys(BookUser::$statuses))
            ],
        ]);

        if (!$book = $request->user()->books->find($book->id)) {
            abort(403);
        }

        $book->update($request->only(['title', 'author'])); // 更新books
        $request->user()->books()->updateExistingPivot($book, [
            'status' => $request->get('status')
        ]); // 更新关联表

        return redirect('/');
    }
}
