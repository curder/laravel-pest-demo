<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterIndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::get('auth/register', RegisterIndexController::class)->name('register');
