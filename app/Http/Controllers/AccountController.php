<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingsUpdate;
use App\Http\Requests\StoreAvatarPicture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AccountController extends Controller
{
    public function __invoke(): Response
    {
        $user = $this->getUserInfo();

        return Inertia::render('Account/Profile', ['userData' => $user]);
    }

    public function settings(): Response
    {
        $user = $this->getUserInfo();

        return Inertia::render('Account/Settings', ['userData' => $user]);
    }

    public function settingsStore(StoreSettingsUpdate $request)
    {
        $updatedData = $request->validated();

        Auth::user()->update([
            'username' => $updatedData['username'],
            'email' => $updatedData['email'],
            'description' => $updatedData['description'],
        ]);

        return to_route('account.settings')->with('message', 'Your account Profile settings have been updated.');
    }

    private function getUserInfo(): array
    {
        $user = Auth::user()->only('username', 'email', 'description');
        $user['created_at'] = Auth::user()->created_at->format('d-m-Y');

        return $user;
    }

    public function avatarStore(StoreAvatarPicture $request): RedirectResponse
    {
        $path = $request->file('avatar')->store('avatars', 'public');

        $user = Auth::user();

        $user?->update(['avatar' => $path]);

        return to_route('account.settings')->with('message', 'Avatar Uploaded');
    }
}
