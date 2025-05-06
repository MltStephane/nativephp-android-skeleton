<?php

use Illuminate\Support\Facades\Route;


Route::middleware('auth_guest')->group(function () {
    Route::get('/', \App\Livewire\Login::class)->name('login');
});

Route::prefix('authenticated')->middleware('auth_logged_in')->group(function () {
    Route::get('/', \App\Livewire\Authenticated\Dashboard::class)->name('homepage');
    Route::get('/logout', \App\Livewire\Authenticated\Logout::class)->name('logout');
});
