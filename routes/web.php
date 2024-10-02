<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home/Home');
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register',[AuthController::class,'registerStore'])->name('registerStore');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login',[AuthController::class,'loginStore'])->name('loginStore');

Route::get('/recover', [AuthController::class, 'recover'])->name('recover');
Route::post ('/recover',[AuthController::class,'recoverStore'])->name('recoverStore');
Route::get('/recover-send',[AuthController::class,'recoverComplete'])->name('recoverSend');

Route::get('/recover-password/{recoverUrl}', [AuthController::class, 'updatePassword'])->name('updatePassword');
Route::post('/recover-password/{recoverUrl}', [AuthController::class, 'updatePasswordStore'])->name('updatePasswordStore');


Route::prefix('account')->name('account.')->group(function () {

Route::get('/profile', AccountController::class)->name('profile');
Route::get('/settings', [AccountController::class, 'settings'])->name('settings');
});
