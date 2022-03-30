<?php

use App\Models\User;
use function Pest\Laravel\post;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('redirects authenticated user', function() {
    expect(User::factory()->create())
        ->toBeRedirectedFor('/auth/register');
});

it('shows the register page')->get('/auth/register')->assertOk();

it('has errors if the details are not provided')
    ->post('/register')
    ->assertSessionHasErrors(['name', 'email', 'password',]);

it('register the user')->tap(
    callable: fn () => post('/register', [
        'name' => 'Mable',
        'email' => 'mable@example.com',
        'password' => 'password',
    ])->assertRedirect('/')
)
    ->assertDatabaseHas('users', [
        'name' => 'Mable',
        'email' => 'mable@example.com',
    ])
    ->assertAuthenticated();
