<?php


use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('redirects unauthenticated users')->expectGuest()->toBeRedirectedFor('/friends', 'post');

it('validates the email address', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post('/friends')
        ->assertSessionHasErrors(['email']);
});

it('validates the email address exists', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post('/friends', [
            'email' => 'example@exmaple.com',
        ])
        ->assertSessionHasErrors(['email']);
});

it('cant add self as friend', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post('/friends', [
            'email' => $user->email,
        ])
        ->assertSessionHasErrors(['email']);
});

it('store the friend request', function () {
    $user = User::factory()->create();
    $friend = User::factory()->create();

    actingAs($user)
        ->post('/friends', [
            'email' => $friend->email,
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('friends', [
        'user_id' => $user->id,
        'friend_id' => $friend->id,
        'accepted' => false,
    ]);
});
