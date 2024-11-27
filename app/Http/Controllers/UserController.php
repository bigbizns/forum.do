<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\UserCountEnum;
use App\Models\Category;
use App\Models\EditRequest;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
        $posts = $this->getUserPosts();

        return Inertia::render('Dashboards/User/YourPosts', ['posts' => $posts]);
    }

    public function yourRequests(): Response
    {
        $requests = EditRequest::where('user_id', Auth::id())->get(['id', 'post_id', 'action', 'title', 'created_at']);

        return Inertia::render('Dashboards/User/YourRequests', ['requests' => $requests]);
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

    private function getUserPosts(): array
    {
        $userId = Auth::id();
        $posts = Post::where('user_id', $userId) ->orderBy('created_at', 'desc')->get();
        $data = [];

        foreach ($posts as $post) {
            $postLikes = $post->PostLike->where('vote', UserCountEnum::One->value)->count();
            $postViews = $post->View->where('post_id', $post->id)->count();
            $categoryTitle = Category::where('id', $post->category_id)->first()->title;
            $subCategoryTitle = SubCategory::where('id', $post->sub_category_id)->first()->title;

            $data[] = [
                'id' => $post->id,
                'title' => $post->title,
                'tradeAction' => $post->tradeAction,
                'description' => $post->description,
                'pinned' => $post->pinned,
                'likes' => $postLikes,
                'views' => $postViews,
                'catTitle' => $categoryTitle,
                'subCatTitle' => $subCategoryTitle,
            ];
        }

        return $data;
    }
}
