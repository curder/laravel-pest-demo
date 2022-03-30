<?php

use App\Http\Controllers\BookPutController;
use App\Http\Controllers\FriendIndexController;
use App\Http\Controllers\FriendPatchController;
use App\Http\Controllers\FriendStoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookEditController;
use App\Http\Controllers\BookStoreController;
use App\Http\Controllers\BookCreateController;
use App\Http\Controllers\RegisterIndexController;

Route::get('/', HomeController::class);

Route::get('auth/register', RegisterIndexController::class)->name('register');
Route::get('auth/login', LoginController::class)->name('login');

Route::put('books/{book}', BookPutController::class)->name('books.update');
Route::get('books/create', BookCreateController::class)->name('books.create');
Route::post('books', BookStoreController::class)->name('books.store');
Route::get('books/{book}/edit', BookEditController::class)->name('books.edit');

Route::get('friends', FriendIndexController::class)->name('friends.index');
Route::post('friends', FriendStoreController::class)->name('friends.store');
Route::patch('friends/{friend}', FriendPatchController::class)->name('friends.update');
