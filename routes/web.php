<?php

use App\Services\AuthenticationService;
use Illuminate\Support\Facades\Route;


Route::middleware('auth_guest')->group(function () {
    Route::get('/login', \App\Livewire\Login::class)->name('login');
    Route::get('/register', \App\Livewire\Register::class)->name('register');
});

Route::prefix('authenticated')->middleware('auth_logged_in')->group(function () {
    Route::get('/', \App\Livewire\Authenticated\Dashboard::class)->name('homepage');
    Route::get('/logout', \App\Livewire\Authenticated\Logout::class)->name('logout');
});

Route::get('/', function () {
    if (AuthenticationService::isLoggedIn()) {
        return redirect()->route('homepage');
    } else {
        return redirect()->route('login');
    }
});
