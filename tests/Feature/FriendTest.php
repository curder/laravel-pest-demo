<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('redirects unauthenticated users')->expectGuest()->toBeRedirectedFor('/friends');

it('shows a list of the user pending friends', function () {
    $user = User::factory()->create();

    $friends = User::factory()->count(4)->create();

    $friends->each(fn ($friend) => $user->addFriend($friend));

    actingAs($user)
        ->get('/friends')
        ->assertOk()
        ->assertSeeTextInOrder(['Pending friend request', ...$friends->pluck('name')->toArray()]);
});

it('shows a list of the users friend requests', function () {
    $user = User::factory()->create();

    $friends = User::factory()->count(4)->create();

    $friends->each(fn ($friend) => $friend->addFriend($user));

    actingAs($user)
        ->get('/friends')
        ->assertOk()
        ->assertSeeTextInOrder(['Friend requests', ...$friends->pluck('name')->toArray()]);
});

it('shows a list of users accepted friends', closure: function () {
    $user = User::factory()->create();

    $friends = User::factory()->count(4)->create();

    $friends->each(function ($friend) use ($user) {
        $user->addFriend($friend);

        return $friend->acceptFriend($user);
    });

    actingAs($user)
        ->get('/friends')
        ->assertOk()
        ->assertSeeTextInOrder(['Friends', ...$friends->pluck('name')->toArray()]);
});
