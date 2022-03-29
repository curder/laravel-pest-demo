<?php

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use function Pest\Laravel\post;

uses(LazilyRefreshDatabase::class);

it('shows the register page')->get('/auth/register')->assertOk();

it('has errors if the details are not provided')
    ->post('/register')
    ->assertSessionHasErrors(['name', 'email', 'password',]);

it('register the user')->tap(callable: fn() => post('/register', [
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
