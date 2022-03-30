<?php

use App\Models\User;
use function Pest\Laravel\post;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('redirects authenticated user', function() {
    expect(User::factory()->create())
        ->toBeRedirectedFor('/auth/login');
});

it('shows an errors if the details are not provided')
    ->post('/login')
    ->assertSessionHasErrors(['email', 'password']);

it('logs the user in')->tap(function() {
    $user = User::factory()->create();
    post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect('/');

})->assertAuthenticated();
