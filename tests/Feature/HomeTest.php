<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

use function Pest\Laravel\get;

uses(LazilyRefreshDatabase::class);

it('greets the user if they are signed out', closure: function () {
    get('/')
        ->assertSee('Bookfriends')
        ->assertSee('Sign up to get started.')
        ->assertDontSeeText(['Feed', 'My books', 'Add a book', 'Logout']);
});

it('shows authenticated menu items if the user is signed in', closure: function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/')
        ->assertSeeTextInOrder([
            $user->name,
            'Feed',
            'My books',
            'Add a book',
            'Friend',
            'Logout',
        ]);
});

it('shows unauthenticated menu items if the user is not signed in', closure: function () {
    get('/')
        ->assertSeeTextInOrder([
            'Home',
            'Login',
            'Register',
        ]);
});
