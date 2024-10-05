<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function showUsersProfile($id): Response
    {
        $user = User::where('id', $id)->first();

        $user['created_at']->toDateString();

        return Inertia::render('UserAccount/UserAccount', ['userData' => $user]);
    }
}
