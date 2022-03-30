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

it('does not create duplicate friend requests', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    $user->addFriend($friend);
    $user->addFriend($friend);

    expect($user->pendingFriendsOfMine)->not()->toHaveCount(2);
});

it('can accept friends', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    $user->addFriend($friend);
    $friend->acceptFriend($user);

    expect($user->acceptedFriendsOfMine)
        ->toHaveCount(1)
        ->pluck('id')->toContain($friend->id)
    ;
});

it('can get all friends', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();
    $another_friend = User::factory()->create();
    $yet_another_friend = User::factory()->create();

    $user->addFriend($friend);
    $user->addFriend($another_friend);
    $user->addFriend($yet_another_friend);

    $friend->acceptFriend($user);
    $yet_another_friend->acceptFriend($user);

    expect($user->friends)->toHaveCount(2);
    expect($friend->friends)->toHaveCount(1);
    expect($another_friend->friends)->toHaveCount(0);
    expect($yet_another_friend->friends)->toHaveCount(1);
});

it('can remove a friend', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    $user->addFriend($friend);
    $friend->acceptFriend($user);
    $user->removeFriend($friend);

    expect($user->friends)
        ->toBeInstanceOf(\Illuminate\Support\Collection::class)
        ->toHaveCount(0);
    expect($friend->friends)
        ->toBeInstanceOf(\Illuminate\Support\Collection::class)
        ->toHaveCount(0);
});
