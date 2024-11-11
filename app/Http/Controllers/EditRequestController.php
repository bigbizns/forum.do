<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEditedPost;
use App\Models\EditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditRequestController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EditRequest $editRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoreEditedPost $request, int $postId)
    {
        $requested = EditRequest::where('post_id', $postId)->firstOrFail();
        $cc = $request->only(['title', 'description']);
        $user = Auth::id();
        $message = 'Your request to edit the post has been submitted for review';
        $errorMessage = 'Your request to edit the post is Already submitted for review';

        if ($requested) {
            return back()->with('warning_message', $errorMessage);
        }

        EditRequest::create([
            'user_id' => $user,
            'post_id' => $postId,
            'title' => $cc['title'],
            'description' => $cc['description'],
        ]);

        return back()->with('message', $message);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EditRequest $editRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EditRequest $editRequest)
    {
        //
    }
}
