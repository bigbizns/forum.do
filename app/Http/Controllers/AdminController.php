<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function __invoke(): Response
    {
        $users = User::get(['id', 'username', 'email', 'points', 'avatar', 'created_at'])->toArray();

        return Inertia::render('Dashboards/Admin/Index', ['users' => $users]);
    }

    public function editRequests(): Response
    {
        return Inertia::render('Dashboards/Admin/EditRequests');
    }

    public function deleteRequests(): Response
    {
        return Inertia::render('Dashboards/Admin/DeleteRequests');

    }

    public function reports(): Response
    {
        return Inertia::render('Dashboards/Admin/Reports');
    }

    public function messages(): Response
    {
        return Inertia::render('Dashboards/Admin/Messages');
    }
}
