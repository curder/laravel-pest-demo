<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

beforeEach(fn () => $this->user = User::factory()->create());

it('only allows authenticated users to post')
    ->post('/books')
    ->assertStatus(302);

it('creates a book', function () {
    actingAs($this->user)
        ->post('/books', [
            'title' => 'A book',
            'author' => 'An author',
            'status' => 'WANT_TO_READ',
        ])->assertRedirect('/');

    $this->assertDatabaseHas('books', [
        'title' => 'A book',
        'author' => 'An author',
    ]);

    $this->assertDatabaseHas('book_user', [
        'user_id' => $this->user->id,
        'status' => 'WANT_TO_READ',
    ]);
});

it('requires a book title author and status')
    ->tap(fn () => actingAs($this->user))
    ->post('/books')
    ->assertSessionHasErrors(['title', 'author', 'status']);
