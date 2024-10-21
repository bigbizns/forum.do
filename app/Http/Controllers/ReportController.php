<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportComment;
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
}
