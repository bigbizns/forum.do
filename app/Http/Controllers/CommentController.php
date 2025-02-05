<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Http\Requests\StorePostVote;
use App\Http\Requests\StoreReportComment;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreComment $request, int $id): RedirectResponse
    {
        $comment = $request->validated();
        $user = Auth::id();

        Comment::create([
            'user_id' => $user,
            'post_id' => $id,
            'comment' => $comment['comment'],
        ]);

        return to_route('post.show', ['id' => $id])->with('message', 'Your comment has been posted successfully!');
    }

    public function storeVote(StorePostVote $request, int $id): RedirectResponse
    {
        $vote = $request->validated('vote');
        $user = Auth::id();
        $message = $vote === true ? 'You have upvoted comment' : 'You have downvoted comment';
        $commentVote = CommentLike::where('user_id', $user)->where('comment_id', $id)->first();

        if ($commentVote) {
            $commentVote->vote = $vote;
            $commentVote->save();

            return back()->with('message', $message);
        }

        CommentLike::create([
            'comment_id' => $id,
            'user_id' => $user,
            'vote' => $vote
        ]);

        return back()->with('message', $message);
    }

    public function update(StoreComment $request, int $commentId): RedirectResponse
    {
        $editedComment = $request->only(['comment','edited']);
        $user = Auth::id();
        $comment = Comment::where('id', $commentId)->first();

        if ($user === $comment->user_id) {
            $comment->update($editedComment);

            return back()->with('message', 'Your comment has been updated successfully!');
        }

        return back();
    }

    public function destroy(int $commentId): RedirectResponse
    {
        $user =Auth::id();
        $comment = Comment::where('id', $commentId)->first();

        if ($user === $comment->user_id) {
            $comment->delete();
        }

        return back()->with('message', 'Your comment has been deleted successfully!');
    }
}
