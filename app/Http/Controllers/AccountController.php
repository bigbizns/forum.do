<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class AccountController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Account/Profile');
    }
    public function settings():Response
    {
        return Inertia::render('Account/Settings');
    }
}
