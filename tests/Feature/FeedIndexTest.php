<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

beforeEach(fn () => $this->user = User::factory()->create());

it('only allows authenticated users to post')->expectGuest()->toBeRedirectedFor('/feeds');

it('shows books of friends', function () {
    $friend = User::factory()->create();
    $another_friend = User::factory()->create();

    $friend->books()->attach($book = \App\Models\Book::factory()->create(), [
        'status' => 'READING',
        'updated_at' => now()->addDay(),
    ]);

    $another_friend->books()->attach($another_book = \App\Models\Book::factory()->create(), [
        'status' => 'WANT_TO_READ',
        'updated_at' => now()->subDay(),
    ]);

    $this->user->addFriend($friend);
    $friend->acceptFriend($this->user);


    $another_friend->addFriend($this->user);
    $this->user->acceptFriend($another_friend);

    actingAs($this->user)
        ->get('/feeds')
        ->assertSeeTextInOrder([
            $friend->name . ' is reading ' . $book->title,
            $another_friend->name . ' wants to read ' . $another_book->title,
        ]);

});
