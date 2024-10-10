<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\CategoryEnum;
use App\Http\Requests\StorePost;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Posts/Index/ForumIndex');
    }

    public function create(): Response
    {
        $categories = CategoryEnum::getCategories();

        return Inertia::render('Posts/Create/CreatePost', ['categories' => $categories]);
    }

    public function store(StorePost $request): RedirectResponse
    {
        $data = $request->all();

        Post::create([
            'user_id' => Auth::user()->id,
            'title' => $data['title'],
            'category' => $data['category'],
            'pinned' => $data['pinned'],
            'description' => $data['description'],
        ]);

        return to_route('home');
        //@TODO: Navigate User to his created post when available
    }
}
