<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FriendDestroyController extends Controller
{
    public function __invoke(Request $request, User $friend): RedirectResponse
    {
        $request->user()?->removeFriend($friend);

        return back();
    }
}
