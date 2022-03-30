<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('redirects unauthenticated users')->expectGuest()->toBeRedirectedFor('/books/1', 'put');

it('fails if the books does not exists', function () {
    actingAs(User::factory()->create())->put('/books/1')->assertNotFound();
});

it('validates the request details', function () {
    $user = User::factory()->create();

    $user->books()->attach($book = Book::factory()->create(), [
        'status' => 'WANT_TO_READ',
    ]);

    actingAs($user)->put('/books/' . $book->id)
        ->assertSessionHasErrors(['title', 'author', 'status']);
});

it('false if the user does not own the book', function () {
    $user = User::factory()->create();
    $another_user = User::factory()->create();

    $another_user->books()->attach($book = Book::factory()->create(), [
        'status' => 'READING',
    ]);

    actingAs($user)
        ->put('/books/' . $book->id)
        ->assertForbidden();
});

it('updates the book', function () {

    $user = User::factory()->create();
    $user->books()->attach($book = Book::factory()->create(), [
        'status' => 'READING',
    ]);

    actingAs($user)
        ->put('/books/' . $book->id, [
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'status' => 'WANT_TO_READ',
        ]);

    $this->assertDatabaseHas('books', [
        'title' => 'Updated Title',
        'author' => 'Updated Author',
    ]);

    $this->assertDatabaseHas('book_user', [
        'book_id' => $book->id,
        'status' => 'WANT_TO_READ',
    ]);

});
