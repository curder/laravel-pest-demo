<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

beforeEach(fn () => $this->user = User::factory()->create());

it('redirects unauthenticated users')->expectGuest()->toBeRedirectedFor('books/1/edit');

it('shows the book details in the form', function () {
   $this->user->books()->attach($book = Book::factory()->create(), [
       'status' => 'READING',
   ]);

   actingAs($this->user)
       ->get('/books/' . $book->id . '/edit')
       ->assertOk()
       ->assertSeeInOrder([$book->title, $book->author, '<option value="READING" selected>'], false)
       ;
});

it('false if the user does not own the book', function () {
    $another_user = User::factory()->create();
    $another_user->books()->attach($book = Book::factory()->create(), [
        'status' => 'READING',
    ]);

    actingAs($this->user)
        ->get('/books/' . $book->id . '/edit')
        ->assertForbidden();
});
