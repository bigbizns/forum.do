<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home/Home');
});

Route::prefix('account')->name('account.')->group(function () {

Route::get('/profile', AccountController::class)->name('profile');
Route::get('/settings', [AccountController::class, 'settings'])->name('settings');
});
