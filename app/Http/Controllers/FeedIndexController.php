<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FeedIndexController extends Controller
{
    public function __invoke(Request $request): View
    {
        $books = $request->user()?->booksOfFriends;

        return view('feeds.index', compact('books'));
    }
}
