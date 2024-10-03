<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register',[AuthController::class,'registerStore'])->name('registerStore');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login',[AuthController::class,'loginStore'])->name('loginStore');

Route::prefix('account')->name('account.')->group(function () {

    Route::get('/profile', AccountController::class)->name('profile');
    Route::get('/settings', [AccountController::class, 'settings'])->name('settings');

    Route::post('/settings', [AccountController::class, 'avatarStore'])->name('avatarStore');
});
