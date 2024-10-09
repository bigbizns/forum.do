<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\LengthEnum;
use App\Http\Requests\StoreAccountPasswordChange;
use App\Http\Requests\StoreSettingsUpdate;
use App\Http\Requests\StoreAvatarPicture;
use App\Http\Requests\StoreVerifyEmailCode;
use App\Mail\EmailVerification;
use App\Models\EmailVerification as EmailVerificationModel;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Random\RandomException;

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
        $user = Auth::user()->only('username', 'email', 'description','email_verified_at');
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

    /**
     * @throws RandomException
     */
    public function sendVerifyEmail(): RedirectResponse
    {
        $user = Auth::user();
        $code = strtoupper($this->generateRandomString(LengthEnum::Five->value));
        $existingCode = EmailVerificationModel::where('user_id',$user?->id)->first();

        if ($existingCode) {
           $existingCode->delete();
        }

        Mail::to($user?->email)->queue(new EmailVerification($code));

        EmailVerificationModel::create([
            'email' => $user?->email,
            'code' => $code,
            'user_id' => $user?->id
        ]);

        return to_route('account.settings')->with('email_message', 'Your email verification link has been sent to your email address.');
    }

    public function verifyEmailStore(StoreVerifyEmailCode $request): RedirectResponse
    {
        $code = $request->validated('code');

        $userFormCode = EmailVerificationModel::where('code', $code)->first();

        if ($userFormCode === null) {
            return Redirect::back()->withErrors(['code' => 'There was a problem verifying your email. Please try again.']);
        }

        $user = Auth::user();

        if ($userFormCode->user_id !== $user->id) {
            return Redirect::back()->withErrors(['code' => 'The verification code you entered is invalid.']);
        }

        User::where('id', $user->id)->update(['email_verified_at' => now()]);

        $userFormCode->delete();

        return to_route('account.settings');
    }

    private function checkCurrentPassword($password): bool
    {
        return Hash::check($password, Auth::user()->getAuthPassword());
    }

    private function updateUsersPassword($password): bool
    {
        return Auth::user()->update(['password' => Hash::make($password)]);
    }

    /**
     * @throws RandomException
     */
    private function generateRandomString(int $length = LengthEnum::TwentyFive->value): string
    {
        $characters = '0123456789abcdefghilkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
