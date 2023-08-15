<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

use function Pest\Laravel\post;

uses(LazilyRefreshDatabase::class);

it('redirects authenticated user', function () {
    expect(User::factory()->create())
        ->toBeRedirectedFor('/auth/login');
});

it('shows the login page')->get('/auth/login')->assertOk();

it('shows an errors if the details are not provided')
    ->post('/login')
    ->assertSessionHasErrors(['email', 'password']);

it('logs the user in')->tap(function () {
    $user = User::factory()->create();
    post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect('/');
})->assertAuthenticated();
