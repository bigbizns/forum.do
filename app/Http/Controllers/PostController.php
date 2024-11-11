<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\LengthEnum;
use App\Enums\ReportTypesEnum;
use App\Enums\TradeActionEnum;
use App\Enums\UserCountEnum;
use App\Http\Requests\StoreEditedPost;
use App\Http\Requests\StorePost;
use App\Models\Category;
use App\Models\Comment;
use App\Models\EditRequest;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostView;
use App\Models\Report;
use App\Models\SubCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function __invoke(): Response
    {
        $posts = $this->getPaginatedPosts();

        return Inertia::render('Posts/Index/ForumIndex', ['posts' => $posts]);
    }

    public function showPost(int $id): Response
    {
        $post = $this->getPostInfo($id);
        $views = $this->getPostViews($id);
        $comments = $this->getComments($id);
        $reportTypes = ReportTypesEnum::getReportTypes();
        $alreadyReported = $this->checkIfReported($id);
        $votes = $this->getPostVotesCount($id);

        return Inertia::render('Posts/Show/ShowPost',
            [
                'post' => $post,
                'comments' => $comments,
                'reportTypes' => $reportTypes,
                'alreadyReported' => $alreadyReported,
                'votes' => $votes,
                'views' => $views,
            ]);
    }

    public function create(): Response
    {
        $categories = Category::all(['id', 'title', 'marketplace']);
        $subCategories = SubCategory::all(['id', 'category_id', 'title']);
        $tradeActions = tradeActionEnum::getTradeActions();

        return Inertia::render('Posts/Create/CreatePost',
            [
                'categories' => $categories,
                'tradeActions' => $tradeActions,
                'subCategories' => $subCategories,
            ]);
    }

    public function store(StorePost $request): RedirectResponse
    {
        $data = $request->all();

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $data['title'],
            'category_id' => $data['category']['id'],
            'sub_category_id' => $data['subCategory'],
            'tradeAction' => $data['tradeAction'],
            'pinned' => $data['pinned'],
            'description' => $data['description'],
        ]);

        return to_route('post.show', $post->id);
    }

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

    private function getPostInfo(int $id): array
    {
        $data = Post::findOrFail($id);

        return [
            'id' => $data->id,
            'user_id' => $data->user_id,
            'title' => $data->title,
            'description' => $data->description,
            'tradeAction' => $data->tradeAction,
            'createdAt' => $data->created_at,
            'views' => $data->views,
            'author' => $data->user,
        ];
    }

    private function getComments(int $id): array
    {
        $data = Comment::where('post_id', $id)->orderby('created_at', 'desc')->get();
        $comments = [];

        foreach ($data as $comment) {
            $downVoteCount = $comment->CommentLike->where('vote', UserCountEnum::Zero->value)->count();
            $upVoteCount = $comment->CommentLike->where('vote', UserCountEnum::One->value)->count();
            $comments[] = [
                'id' => $comment->id,
                'comment' => $comment->comment,
                'author' => $comment->User->username,
                'authorId' => $comment->User->id,
                'author_avatar' => $comment->User->avatar,
                'edited' => $comment->edited,
                'commentVotes' => [
                    'upVote' => $upVoteCount,
                    'downVote' => $downVoteCount,
                ],
            ];
        }

        return $comments;
    }

    private function getPaginatedPosts(): array
    {
        $recentPosts = Post::orderBy('created_at', 'desc')->paginate(LengthEnum::Ten->value);

        $posts = [];

        foreach ($recentPosts as $recentPost) {
            $posts[] = [
                'id' => $recentPost->id,
                'user_id' => $recentPost->user_id,
                'title' => $recentPost->title,
                'tradeAction' => $recentPost->tradeAction,
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

    private function checkIfReported(int $id): bool
    {
        $userId = Auth::id();
        $report = Report::where('post_id', $id)->where('user_id', $userId)->first();
        $post = Post::where('id', $id)->first();

        $alreadyReported = false;

        if ($report) {
            $alreadyReported = true;
        }

        if ($post->user_id === $userId) {
            $alreadyReported = true;
        }

        return $alreadyReported;
    }

    private function getPostVotesCount(int $postId): array
    {
        $totalVotes = PostLike::where('post_id', $postId)->get();

        $votes = [
            'downVote' => [],
            'upVote' => [],
        ];

        foreach ($totalVotes as $vote) {
            if ($vote->vote === 0) {
                $votes['downVote'][] = [$vote];
            } else {
                $votes['upVote'][] = [$vote];
            }
        }

        return [
            'downVote' => count($votes['downVote']),
            'upVote' => count($votes['upVote']),
        ];
    }

    private function getPostViews(int $postId): int
    {
        $user = Auth::id();
        $data = Post::findOrFail($postId);
        $viewed = $data->View->where('user_id', $user);

        if (!$user) {
            return $data->View->where('post_id', $postId)->count();
        }

        if (!count($viewed)) {
            PostView::create([
                'user_id' => $user,
                'post_id' => $postId,
            ]);
        }

        return $data->View->where('post_id', $postId)->count();
    }
}
