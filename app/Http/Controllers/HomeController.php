<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $user = $this->getUserInfo();

        return Inertia::render('Home/Home',['userData' => $user]);
    }

    private function getUserInfo(): array|string
    {
        $user = Auth::user();

        if ($user === null) {
            return '';
        }

        $userInfo = $user->only('username', 'email', 'description', 'email_verified_at');

        $userInfo['created_at'] = $user->created_at->format('d-m-Y');

        return $userInfo;
    }
}
