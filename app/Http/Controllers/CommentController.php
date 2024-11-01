<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Http\Requests\StorePostVote;
use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Comment $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comments)
    {
        //
    }
}
