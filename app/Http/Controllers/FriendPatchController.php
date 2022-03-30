<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FriendPatchController extends Controller
{
    public function __invoke(Request $request, User $friend): RedirectResponse
    {
        $request->user()?->pendingFriendsOf()->updateExistingPivot($friend->id, [
            'accepted' => true,
        ], false);

        return back();
    }
}
