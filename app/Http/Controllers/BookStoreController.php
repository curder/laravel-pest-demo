<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookStoreController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request) : RedirectResponse
    {

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'status' => 'required',
        ]);

        $book = Book::query()->create($request->only(['title', 'author']));


        $request->user()->books()->attach($book, [
            'status' => $request->get('status'),
        ]);


        return redirect('/');
    }
}
