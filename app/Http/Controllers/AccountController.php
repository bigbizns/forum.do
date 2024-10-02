<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
}
