<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountPasswordChange;
use App\Http\Requests\StoreSettingsUpdate;
use App\Http\Requests\StoreAvatarPicture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function settingsStore(StoreSettingsUpdate $request): RedirectResponse
    {
        $updatedData = $request->validated();

        Auth::user()->update([
            'username' => $updatedData['username'],
            'email' => $updatedData['email'],
            'description' => $updatedData['description'],
        ]);

        return to_route('account.settings')->with('profile_message', 'Your account Profile settings have been updated.');
    }

    public function updatePassword(StoreAccountPasswordChange $request): RedirectResponse
    {
        if (!$this->checkCurrentPassword($request['current_password'])) {
            return to_route('account.settings')->withErrors(['current_password' => 'Your current password is incorrect.']);
        }

        $this->updateUsersPassword($request['new_password']);

        return to_route('account.settings')->with('updatedPassword_message', 'Your password has been updated.');
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

        return to_route('account.settings')->with('avatar_message', 'Avatar Uploaded');
    }

    private function checkCurrentPassword($password): bool
    {
        return Hash::check($password, Auth::user()->getAuthPassword());
    }

    private function updateUsersPassword($password): bool
    {
        return Auth::user()->update(['password' => Hash::make($password)]);
    }
}
