<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth.user' => fn() => $request->user()
                ? $request->user()->only('username', 'avatar', 'id', 'is_admin')
                : null,
            'flash' => [
                'profile_message' => fn() => $request->session()->get('profile_message'),
                'avatar_message' => fn() => $request->session()->get('avatar_message'),
                'message' => fn() => $request->session()->get('message'),
                'warning_message' => fn() => $request->session()->get('warning_message'),
                'updatedPassword_message' => fn() => $request->session()->get('updatedPassword_message'),
                'email_message' => fn() => $request->session()->get('email_message'),
            ],
        ]);
    }
}
