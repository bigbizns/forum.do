<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function showUsersProfile($id): Response|RedirectResponse
    {
        $user = User::where('id', $id)->first();

        if ($user === null) {
            return to_route('home');
        }

        $user['created_at']->toDateString();

        $userPosts = $user->post()->orderBy('created_at', 'desc')->take(3)->get();

        return Inertia::render('UserAccount/UserAccount', ['userData' => $user, 'userPosts' => $userPosts]);
    }
}
