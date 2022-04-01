<?php

use App\Models\Pivot\BookUser;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

beforeEach(fn () => $this->user = User::factory()->create());

it('only allows authenticated users')->expectGuest()->toBeRedirectedFor('/books/create', 'get');

it('shows the available statuses on the form', function () {
    actingAs($this->user)
        ->get('/books/create')
        ->assertSeeTextInOrder(BookUser::$statuses)
    ;
});
