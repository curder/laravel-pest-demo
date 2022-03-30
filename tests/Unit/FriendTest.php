<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('can have pending friends', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    $user->addFriend($friend);

    expect($user->pendingFriendsOfMine)->toHaveCount(1);
});

it('can have friend requests', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    $friend->addFriend($user);

    expect($user->pendingFriendsOf)->toHaveCount(1);
});
