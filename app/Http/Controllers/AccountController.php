<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreAvatarPicture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AccountController extends Controller
{
    public function __invoke(): Response
    {
        $user = Auth::user()->only('username', 'email');
        $user['created_at'] = Auth::user()->created_at->format('d-m-Y');


        return Inertia::render('Account/Profile', ['userData' => $user]);
    }

    public function settings(): Response
    {
        return Inertia::render('Account/Settings');
    }

    public function avatarStore(StoreAvatarPicture $request): RedirectResponse
    {
        $path = $request->file('avatar')->store('avatars', 'public');

        $user = Auth::user();

        $user?->update(['avatar' => $path]);

        return to_route('account.settings')->with('message', 'Avatar Uploaded');
    }
}
