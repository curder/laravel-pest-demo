<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FriendStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => [
                'required',
                'exists:users,email',
                // @phpstan-ignore-next-line
                Rule::notIn($request->user()->email),
            ],
        ]);

        // @phpstan-ignore-next-line
        $request->user()->addFriend(
            User::query()->where('email', $request->get('email'))->first()
        );

        return back();
    }
}
