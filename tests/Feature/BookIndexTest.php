<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

beforeEach(fn () => $this->user = User::factory()->create());

it('shows books the use wants to read', function() {
    $this->user?->books()->attach($book = Book::factory()->create(), [
        'status' => 'WANT_TO_READ',
    ]);

    actingAs($this->user)
        ->get('/')
        ->assertSeeTextInOrder(['Want to read', $book->title])
    ;
});

it('shows books the use reading', function() {
    $this->user?->books()->attach($book = Book::factory()->create(), [
        'status' => 'READING',
    ]);

    actingAs($this->user)
        ->get('/')
        ->assertSeeTextInOrder(['Reading', $book->title])
    ;
});


it('shows books the use read', function() {
    $this->user?->books()->attach($book = Book::factory()->create(), [
        'status' => 'READ',
    ]);

    actingAs($this->user)
        ->get('/')
        ->assertSeeTextInOrder(['Read', $book->title])
    ;
});
