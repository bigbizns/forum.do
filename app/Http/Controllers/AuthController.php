<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginUser;
use App\Http\Requests\StoreRegisterUser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

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
            //@TODO: When Home route is set up update route
            return to_route('home');
        }

        return Redirect::back()->withErrors(['message' => 'Invalid login credentials']);
    }
}
