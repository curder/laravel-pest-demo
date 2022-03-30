<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookPutController;
use App\Http\Controllers\BookEditController;
use App\Http\Controllers\BookStoreController;
use App\Http\Controllers\FeedIndexController;
use App\Http\Controllers\BookCreateController;
use App\Http\Controllers\RegisterIndexController;
use App\Http\Controllers\FriendIndexController;
use App\Http\Controllers\FriendPatchController;
use App\Http\Controllers\FriendStoreController;
use App\Http\Controllers\FriendDestroyController;

Route::get('/', HomeController::class)->name('index');

Route::middleware(['guest'])->prefix('auth')->group(function() {
    Route::get('register', RegisterIndexController::class)->name('register');
    Route::get('login', LoginController::class)->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('books')->as('books.')->group(function() {
        Route::put('{book}', BookPutController::class)->name('update');
        Route::get('create', BookCreateController::class)->name('create');
        Route::post('/', BookStoreController::class)->name('store');
        Route::get('{book}/edit', BookEditController::class)->name('edit');
    });

    Route::prefix('friends')->as('friends.')->group(function() {
        Route::get('', FriendIndexController::class)->name('index');
        Route::post('', FriendStoreController::class)->name('store');
        Route::patch('{friend}', FriendPatchController::class)->name('update');
        Route::delete('{friend}', FriendDestroyController::class)->name('destroy');
    });

    Route::get('feeds', FeedIndexController::class)->name('feeds.index');
});
