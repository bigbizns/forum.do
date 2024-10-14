<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $user = $this->getUserInfo();
        $recentPosts = $this->getFullPostInformation();

        return Inertia::render('Home/Home', ['userData' => $user, 'recentPosts' => $recentPosts]);
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

    private function getFullPostInformation(): array
    {
        $recentPosts = Post::all()->sortByDesc('created_at');

        $posts = [];

        foreach ($recentPosts as $recentPost) {
            $posts[] = [
                'id' => $recentPost->id,
                'user_id' => $recentPost->user_id,
                'title' => $recentPost->title,
                'description' => $recentPost->description,
                'created_at' => $recentPost->created_at->format('d-m-Y'),
                'avatar' => $recentPost->user->avatar,
            ];
        }

        return $posts;
    }
}
