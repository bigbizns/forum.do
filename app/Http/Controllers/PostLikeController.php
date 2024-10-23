<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StorePostLike;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
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
    public function store(StorePostLike $request, int $id)
    {
        $vote = $request->validated();
        $userId = Auth::id();
        $postId = $id;
        $message = $vote['vote'] === true ? 'You have liked this post' : 'You have disliked this post';
        $postLike = PostLike::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($postLike) {
            $postLike->vote = $vote['vote'];
            $postLike->save();

            return to_route('post.show', $postId)->with('message', $message);
        }

        PostLike::create([
            'user_id' => $userId,
            'post_id' => $postId,
            'vote' => $vote['vote']
        ]);


        return to_route('post.show', $postId)->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(PostLike $postLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostLike $postLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostLike $postLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostLike $postLike)
    {
        //
    }
}
