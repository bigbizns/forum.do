<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportComment;
use App\Http\Requests\StoreReportUser;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(StoreReportComment $request, int $id): RedirectResponse
    {
        $postId = $id;
        $report = $request->validated();

        Report::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'reason' => $report['reason'],
            'message' => $report['message'],
        ]);

        return to_route('post.show', ['id' => $postId])->with('message', 'Your report has been posted successfully!');
    }

    public function reportUser(StoreReportUser $request, int $id): RedirectResponse
    {
        $userId = $id;
        $report = $request->all();
        $reports = Report::all();

        foreach ($reports as $report) {
            if ($report['user_id'] === Auth::id() && (int)$report['reported_user_id'] === $userId) {
                return to_route('user.profile', ['id' => $userId])->with('warning_message', 'You already reported this person');
            }
        }

        Report::create([
            'user_id' => Auth::id(),
            'reported_user_id' => $userId,
            'reason' => $report['reason'],
            'message' => $report['message'],
        ]);

        return to_route('user.profile', ['id' => $userId])->with('message', 'Your report has been submitted successfully!');
    }

    public function reportComment(StoreReportComment $request, int $commentId): RedirectResponse
    {
        $user = Auth::id();
        $comment = Comment::where('id', $commentId)->first();
        $alreadyReported = Report::where('comment_id', $commentId)->first();

        if ($alreadyReported) {
            return back()->with('warning_message', 'You already reported this comment.');
        }

        Report::create([
            'user_id' => $user,
            'comment_id' => $commentId,
            'reported_comment' => $comment['comment'],
            'reason' => $request['reason'],
            'message' => $request['message'],
        ]);

        return back()->with('message', 'Comment has been reported successfully!');
    }
}
