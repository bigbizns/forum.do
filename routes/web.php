<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/user/{id}', [UserController::class, 'showUsersProfile'])->name('user.profile');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerStore'])->name('registerStore');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginStore'])->name('loginStore');

    Route::get('/recover', [AuthController::class, 'recover'])->name('recover');
    Route::post('/recover', [AuthController::class, 'recoverStore'])->name('recoverStore');
    Route::get('/recover-send', [AuthController::class, 'recoverComplete'])->name('recoverSend');

    Route::get('/recover-password/{recoverUrl}', [AuthController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/recover-password/{recoverUrl}', [AuthController::class, 'updatePasswordStore'])->name('updatePasswordStore');
});

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/profile', AccountController::class)->name('profile');

        Route::get('/settings', [AccountController::class, 'settings'])->name('settings');

        Route::post('/settings', [AccountController::class, 'settingsStore'])->name('settingsStore');
        Route::post('/settings/upload-avatar', [AccountController::class, 'avatarStore'])->name('avatarStore');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});




