<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\RequestEnum;
use App\Mail\MessageAnswer;
use App\Models\Contact;
use App\Models\EditRequest;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $editRequests = EditRequest::where('action', RequestEnum::Edit->value)->get();

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
        $deleteRequests = EditRequest::where('action', RequestEnum::Delete->value)->get();

        return Inertia::render('Dashboards/Admin/DeleteRequests', ['deleteRequests' => $deleteRequests]);
    }

    public function deleteRequest(Request $request): RedirectResponse
    {
        $post = Post::where('id', $request['postId'])->first();
        $editRequest = EditRequest::where('post_id', $request['postId'])->first();

        $editRequest->delete();
        $post->delete();

        return redirect()->back()->with('message', "Deleted {$post->title}");
    }

    public function reports(): Response
    {
        $data = Report::all();
        $reports = [];

        foreach ($data as $report) {
            $user = User::where('id', $report->user_id)->first();

            $reports[] = [
                'id' => $report->id,
                'userId' => $user->id,
                'reason' => $report->reason,
                'message' => $report->message,
                'userName' => $user->username,
                'avatar' => $user->avatar,
            ];
        }

        return Inertia::render('Dashboards/Admin/Reports', ['reports' => $reports]);
    }

    public function deleteReportedPost(Request $request): RedirectResponse
    {
        $postId = $request['postId'];

        $post = Post::where('id', $postId)->first();
        $report = Report::where('post_id', $postId)->first();

        $report->delete();
        $post->delete();

        return redirect()->back()->with('message', "Deleted {$post->title}");
    }

    public function messages(): Response
    {
        $messages = Contact::all();

        return Inertia::render('Dashboards/Admin/Messages', ['messages' => $messages]);
    }

    public function sendMessage(Request $request): RedirectResponse
    {
        Mail::to($request->userEmail)->queue(new MessageAnswer($request->topic, $request->userMessage, $request->answer));

        return to_route('admin.dashboard.messages')->with('message', 'Message sent!');
    }
}
