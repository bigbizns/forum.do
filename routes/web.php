<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/{Category?}', HomeController::class)->name('home');

Route::get('/forum', PostController::class)->name('forum');

Route::get('/user/{id}', [UserController::class, 'showUsersProfile'])->name('user.profile');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('info')->name('info.')->group(function () {
   Route::get('about-us', [InfoController::class, 'AboutUs'])->name('about-us');
   Route::get('services', [InfoController::class, 'Services'])->name('services');
   Route::get('terms', [InfoController::class, 'Terms'])->name('terms');
});

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

        Route::post('/settings-save', [AccountController::class, 'settingsStore'])->name('settings.store');
        Route::post('/settings-upload-avatar', [AccountController::class, 'avatarStore'])->name('avatar.store');

        Route::post('/settings-update-password', [AccountController::class, 'updatePassword'])->name('update.password');

        Route::post('/settings-send-verification-email', [AccountController::class, 'sendVerifyEmail'])->name('send.verify.email');
        Route::post('/settings-verify-email', [AccountController::class, 'verifyEmailStore'])->name('verify.email.store');
    });

    Route::get('/post-create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post-store', [PostController::class, 'store'])->name('post.store');
    Route::post('/post-edit/{postId}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post-destroy/{postId}', [PostController::class, 'destroy'])->name('post.delete');

    Route::get('/contact-us', ContactUsController::class)->name('contactus');
    Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contactus.store');

    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/{id}', [PostController::class, 'showPost'])->name('show')->withoutMiddleware('auth');

        Route::post('/vote/{id}', [PostLikeController::class, 'store'])->name('vote');

        Route::post('/report/{id}', [ReportController::class, 'store'])->name('report');

        Route::post('/comment-post/{id}', [CommentController::class, 'store'])->name('comment');
        Route::post('/comment-vote/{commentId}', [CommentController::class, 'storeVote'])->name('comment.vote');
        Route::post('/comment-edit/{commentId}', [CommentController::class, 'edit'])->name('comment.edit');
        Route::post('/comment-delete/{commentId}', [CommentController::class, 'destroy'])->name('comment.delete');
    });
});
