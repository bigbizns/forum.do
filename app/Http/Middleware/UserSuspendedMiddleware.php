<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\UserAccountEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserSuspendedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->suspended === UserAccountEnum::Suspended->value) {
            return to_route('home');
        }

        return $next($request);
    }
}
