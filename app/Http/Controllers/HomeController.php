<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $user = $this->getUserInfo();
        $recentPosts = $this->getPaginatedPosts();
        $categories = Category::all(['id', 'title']);

        return Inertia::render('Home/Home',
            [
                'userData' => $user,
                'recentPosts' => $recentPosts,
                'categories' => $categories
            ]
        );
    }

    private function getUserInfo(): array|string
    {
        $user = Auth::user();

        if ($user === null) {
            return '';
        }

        $userInfo = $user->only('username', 'email', 'description', 'email_verified_at');

        $userInfo['created_at'] = $user->created_at->format('d-m-Y');

        return $userInfo;
    }

    private function getPaginatedPosts(): array
    {
        $recentPosts = Post::orderBy('created_at', 'desc')->paginate(3);

        $posts = [];

        foreach ($recentPosts as $recentPost) {
            $posts[] = [
                'id' => $recentPost->id,
                'user_id' => $recentPost->user_id,
                'title' => $recentPost->title,
                'tradeAction'=> $recentPost->tradeAction,
                'description' => $recentPost->description,
                'created_at' => $recentPost->created_at->format('d-m-Y'),
                'avatar' => $recentPost->user->avatar,
            ];
        }

        return [
            'data' => $posts,
            'pagination' => [
                'links' => $recentPosts->linkCollection(),
                'current_page' => $recentPosts->currentPage(),
                'last_page' => $recentPosts->lastPage(),
                'per_page' => $recentPosts->perPage(),
                'total' => $recentPosts->total(),
                'next_page_url' => $recentPosts->nextPageUrl(),
                'prev_page_url' => $recentPosts->previousPageUrl(),
            ],
        ];
    }
}
