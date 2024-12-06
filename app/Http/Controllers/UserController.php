<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ReportTypesEnum;
use App\Enums\UserCountEnum;
use App\Models\Category;
use App\Models\Comment;
use App\Models\EditRequest;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Dashboards/User/Index');
    }

    public function showUsersProfile(int $id): Response|RedirectResponse
    {
        $user = User::where('id', $id)->first();

        if ($user === null) {
            return to_route('home');
        }

        $postCount = count($user->Post);
        $commentCount = count($user->Comment);
        $commentLikes = $this->getCommentLikes($user);
        $postLikes = $this->getPostLikes($user);
        $reportTypes = ReportTypesEnum::getReportTypes();
        $totalLikes = $this->getTotalLikes($postLikes, $commentLikes);
        $userActivity = $this->getUsersActivity($id);

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
            'reportTypes' => $reportTypes,
            'userActivity' => $userActivity,
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

    public function cancelRequest(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $userRequest = EditRequest::where('id', $id)->first();

        $userRequest->delete();

        return to_route('dashboard.your.requests')->with('message', 'Your request has been cancelled.');
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

    private function getUsersActivity(int $id): array
    {
        $user = User::where('id', $id)->first();
        $postAct = Post::where('user_id', $user->id)->latest()->get()->toArray();
        $commentAct = Comment::where('user_id', $user->id)->latest()->get()->toArray();
        $data = array_merge($postAct, $commentAct);

        usort($data, function ($a, $b) {
            return strtotime($b['created_at']) <=> strtotime($a['created_at']);
        });

        $activities = array_slice($data, 0, 3);
        $latestActivity = [];

        foreach ($activities as $activity) {
            if (!empty($activity['sub_category_id'])) {
                $subCategory = SubCategory::where('id', $activity['sub_category_id'])->first();
                $category = Category::where('id', $activity['category_id'])->first();
                $latestActivity[] = [
                    'action' => 'Posted',
                    'subTitle' => $subCategory->title,
                    'catTitle' => $category->title,
                    'postTitle' => $activity['title'],
                    'postDescription' => $activity['description'],
                    'post_id' => $activity['id'],
                    'created_at' => $activity['created_at'],
                ];
            }
            if (!empty($activity['comment'])) {
                $post = Post::where('id', $activity['post_id'])->first();
                $latestActivity[] = [
                    'action' => 'Commented',
                    'post_id' => $post->id,
                    'postTitle' => $post->title,
                    'comment' => $activity['comment'],
                    'created_at' => $activity['created_at'],
                ];
            }
        }

        return $latestActivity;
    }
}
