<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/user/{id}', [UserController::class, 'showUsersProfile'])->name('user.profile');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginStore'])->name('login.store');

    Route::get('/recover', [AuthController::class, 'recover'])->name('recover');
    Route::post('/recover', [AuthController::class, 'recoverStore'])->name('recover.store');
    Route::get('/recover-send', [AuthController::class, 'recoverComplete'])->name('recover.send');

    Route::get('/recover-password/{recoverUrl}', [AuthController::class, 'updatePassword'])->name('update.password');
    Route::post('/recover-password/{recoverUrl}', [AuthController::class, 'updatePasswordStore'])->name('update.password.store');
});

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/profile', AccountController::class)->name('profile');

        Route::get('/settings', [AccountController::class, 'settings'])->name('settings');

        Route::post('/settings', [AccountController::class, 'settingsStore'])->name('settings.store');
        Route::post('/settings/upload-avatar', [AccountController::class, 'avatarStore'])->name('avatar.store');

        Route::post('/settings/update-password', [AccountController::class, 'updatePassword'])->name('update.password');

        Route::post('/settings/send-verification-email', [AccountController::class, 'sendVerifyEmail'])->name('send.verify.email');
        Route::post('/settings/verify-email', [AccountController::class, 'verifyEmailStore'])->name('verify.email.store');
    });

    Route::get('/forum', PostController::class)->name('forum');
    Route::get('/create-post', [PostController::class, 'create'])->name('post.create');

    Route::get('/contact-us', ContactUsController::class)->name('contactus');
    Route::post('/contact-us-store', [ContactUsController::class, 'store'])->name('contactus.store');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});




