<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

beforeEach(fn () => $this->user = User::factory()->create());

it('shows books with the correct status', function (string $status, string $heading) {
    $this->user?->books()->attach($book = Book::factory()->create(), [
        'status' => $status,
    ]);

    actingAs($this->user)
        ->get('/')
        ->assertSeeTextInOrder([$heading, $book->title])
    ;
})->with([
    ['status' => 'WANT_TO_READ', 'heading' => 'Want to read'],
    ['status' => 'READING', 'heading' => 'Reading'],
    ['status' => 'READ', 'heading' => 'Read'],
]);
