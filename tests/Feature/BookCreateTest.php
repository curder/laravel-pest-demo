<?php

use App\Models\Pivot\BookUser;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

 beforeEach(fn () => $this->user = User::factory()->create());

it('only allows authenticated users')
    ->get('/books/create')
    ->assertStatus(302);

it('shows the available statuses on the form', function () {
    actingAs($this->user)
        ->get('/books/create')
        ->assertSeeTextInOrder(BookUser::$statuses)
    ;
});
