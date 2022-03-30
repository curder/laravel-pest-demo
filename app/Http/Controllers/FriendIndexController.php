<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FriendIndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request): View
    {
        $pending_friends = $request->user()?->pendingFriendsOfMine;
        $requesting_friends = $request->user()?->pendingFriendsOf;
        $friends = $request->user()?->friends;

        return view('friends.index', compact('pending_friends', 'requesting_friends', 'friends'));
    }
}
