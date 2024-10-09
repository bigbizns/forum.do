<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\LengthEnum;
use App\Http\Requests\StoreLoginUser;
use App\Http\Requests\StoreRegisterUser;
use App\Http\Requests\StoreUpdatedPassword;
use App\Http\Requests\StoreUserRecovery;
use App\Mail\RecoveryLink;
use App\Models\RecoveryLink as recovery_links;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Random\RandomException;

class AuthController extends Controller
{
    public function register(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function registerStore(StoreRegisterUser $request): RedirectResponse
    {
        $user = $request->validated();

        User::create($user);

        return to_route('login');
    }

    public function login(): Response
    {
        return Inertia::render('Auth/Login');
    }

    public function loginStore(StoreLoginUser $request): RedirectResponse
    {
        $user = $request->validated();

        if (Auth::attempt($user, $request->remember)) {
            $request->session()->regenerate();
            return to_route('home');
        }

        return Redirect::back()->withErrors(['message' => 'Invalid login credentials']);
    }

    public function recover(): Response
    {
        return Inertia::render('Auth/RecoverPassword');
    }

    /**
     * @throws RandomException
     */
    public function recoverStore(StoreUserRecovery $request): RedirectResponse
    {
        $email = $request->validated('email');

        $user = User::where('email', $email)->first();
        $usersRecoveryLink = recovery_links::where('email', $email)->first();

        if (empty($user)) {
            return to_route('recover')->withErrors(['message' => 'Entered email does not exist']);
        }

        if (!empty($usersRecoveryLink)) {
            $usersRecoveryLink->delete();
        }

        $recoverUrl = $this->generateRandomString();

        Mail::to($user->email)->queue(new RecoveryLink($recoverUrl));

        recovery_links::create([
            'email' => $user->email,
            'user_id' => $user->id,
            'recovery_link' => $recoverUrl,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return to_route('recover.send');
    }

    public function recoverComplete(): Response
    {
        return Inertia::render('Auth/RecoverySend');
    }

    public function updatePassword(): Response
    {
        return Inertia::render('Auth/UpdatePassword');
    }

    public function updatePasswordStore(StoreUpdatedPassword $request): RedirectResponse
    {
        $url = $this->getRequestURL();

        $data = recovery_links::where('recovery_link', $url)->first();

        if (empty($data)) {
            return to_route('recover')->withErrors(['message' => 'Something went wrong, try again later']);
        }

        $user = User::where('email', $data->email)->firstorFail();

        $user->password = Hash::make($request->validated()['password']);
        $user->save();

        $data->delete();

        return to_route('login')->with('message', 'Password updated successfully');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('login');
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

    private function getRequestURL(): string
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);

        return $url[2];
    }
}
