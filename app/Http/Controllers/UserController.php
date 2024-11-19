<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\UserCountEnum;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Dashboards/User/Index');
    }

    public function showUsersProfile($id): Response|RedirectResponse
    {
        $user = User::where('id', $id)->first();

        if ($user === null) {
            return to_route('home');
        }

        $postCount = count($user->Post);
        $commentCount = count($user->Comment);
        $commentLikes = $this->getCommentLikes($user);
        $postLikes = $this->getPostLikes($user);
        $totalLikes = $this->getTotalLikes($postLikes, $commentLikes);

        $user['created_at']->toDateString();

        $userPosts = $user->post()->orderBy('created_at', 'desc')->take(3)->get();

        $userStats = [
            'postCount' => $postCount,
            'commentCount' => $commentCount,
            'likes' => $totalLikes,
        ];

        return Inertia::render('UserAccount/UserAccount', [
            'userData' => $user,
            'userPosts' => $userPosts,
            'userStats' => $userStats,
        ]);
    }

    public function yourPosts(): Response
    {
        return Inertia::render('Dashboards/User/YourPosts');
    }

    public function yourRequests(): Response
    {
        return Inertia::render('Dashboards/User/YourRequests');
    }

    private function getCommentLikes(User $user): int
    {
        $comments = $user->Comment;
        $commentVotesCount = UserCountEnum::Zero->value;

        foreach ($comments as $comment) {
            $commentVotes = $comment->CommentLike->where('vote', UserCountEnum::One->value);
            $commentVotesCount += $commentVotes->count();
        }

        return $commentVotesCount;
    }

    private function getPostLikes(User $user): int
    {
        $posts = $user->Post;
        $postVotesCount = UserCountEnum::Zero->value;

        foreach ($posts as $post) {
            $postVotes = $post->PostLike->where('vote', UserCountEnum::One->value);
            $postVotesCount += $postVotes->count();
        }

        return $postVotesCount;
    }

    private function getTotalLikes(int $postLikes, int $commentLikes): int
    {
        return $commentLikes + $postLikes;
    }
}
