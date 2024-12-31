<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ReportTypeEnum;
use App\Enums\RequestEnum;
use App\Mail\MessageAnswer;
use App\Models\Comment;
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
use Illuminate\Database\Eloquent\Collection;

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
        $reports = $this->categorizeReports($data);

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

    public function deleteReportedComment(Request $request): RedirectResponse
    {
        $report = Report::where('id', $request['reportId'])->first();
        $comment = Comment::where('id', $request['commentId'])->first();

        $comment->delete();
        $report->delete();

        return redirect()->back()->with('message', 'Comment Has been deleted');
    }

    public function messages(): Response
    {
        $messages = Contact::all();

        return Inertia::render('Dashboards/Admin/Messages', ['messages' => $messages]);
    }

    public function sendMessage(Request $request): RedirectResponse
    {
        $userMessage = Contact::find($request['id']);
        $sendEmail = $this->sendEmail($request->userEmail, $request->topic, $request->userMessage, $request->answer);

        if ($sendEmail === true) {
            $userMessage->delete();
        }

        return to_route('admin.dashboard.messages')->with('message', 'Message sent!');
    }

    private function sendEmail(string $email, string $topic, string $message, string $answer): RedirectResponse|bool
    {
        try {
            Mail::to($email)->queue(new MessageAnswer($topic, $message, $answer));

            return true;
        } catch (\Exception $exception) {
            return to_route('admin.dashboard.messages')->with('message', $exception->getMessage());
        }
    }

    private function categorizeReports(Collection $reports): array
    {
        $data = [];

        foreach ($reports as $report) {
            $user = User::where('id', $report->user_id)->first();

            if ($report['post_id'] !== null) {
                $data[] = [
                    'id' => $report->id,
                    'postId' => $report->post->id,
                    'userId' => $user->id,
                    'reason' => $report->reason,
                    'message' => $report->message,
                    'userName' => $user->username,
                    'avatar' => $user->avatar,
                    'type' => ReportTypeEnum::Post->value
                ];
            }

            if ($report['comment_id'] !== null) {
                $data[] = [
                    'id' => $report->id,
                    'userId' => $report->user_id,
                    'commentId' => $report->comment_id,
                    'reason' => $report->reason,
                    'message' => $report->message,
                    'userName' => $user->username,
                    'avatar' => $user->avatar,
                    'type' => ReportTypeEnum::Comment->value
                ];
            }

            if ($report['reported_user_id'] !== null) {
                $data[] = [
                    'id' => $report->id,
                    'userId' => $report->user_id,
                    'reportedUserId' => $report->reported_user_id,
                    'reason' => $report->reason,
                    'message' => $report->message,
                    'userName' => $user->username,
                    'avatar' => $user->avatar,
                    'type' => ReportTypeEnum::Profile->value
                ];
            }
        }

        return $data;
    }
}
