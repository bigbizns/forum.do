<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\EditRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $editRequests = EditRequest::all();

        return Inertia::render('Dashboards/Admin/EditRequests', ['editRequests' => $editRequests]);
    }

    public function approveEditRequest(Request $request): RedirectResponse
    {
        $data = $request->all();
        $post = Post::where('id', $data['postId'])->first();

        $post->update($data);
        $editRequest = EditRequest::where('post_id', $data['postId'])->first();
        $editRequest->delete();

        return redirect()->back()->with('message', "Approved {$post->title}");
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
