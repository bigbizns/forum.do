<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ReportTypesEnum;
use App\Enums\TradeActionEnum;
use App\Http\Requests\StoreComment;
use App\Http\Requests\StorePost;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
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
        $comments = $this->getComments($id);
        $reportTypes = ReportTypesEnum::getReportTypes();

        return Inertia::render('Posts/Show/ShowPost',
            [
                'post' => $post,
                'comments' => $comments,
                'reportTypes' => $reportTypes
            ]);
    }

    public function create(): Response
    {
        $categories = Category::all(['id', 'title', 'marketplace']);
        $tradeActions = tradeActionEnum::getTradeActions();

        return Inertia::render('Posts/Create/CreatePost', ['categories' => $categories, 'tradeActions' => $tradeActions]);
    }

    public function store(StorePost $request): RedirectResponse
    {
        $data = $request->all();

        Post::create([
            'user_id' => Auth::user()->id,
            'title' => $data['title'],
            'category_id' => $data['category']['id'],
            'tradeAction' => $data['tradeAction'],
            'pinned' => $data['pinned'],
            'description' => $data['description'],
        ]);

        return to_route('home');
        //@TODO: Navigate User to his created post when available
    }

    public function storeComment(StoreComment $request, int $id): RedirectResponse
    {
        $comment = $request->validated();
        $user = Auth::user();

        Comment::create([
            'user_id' => $user['id'],
            'post_id' => $id,
            'comment' => $comment['comment'],
        ]);

        return to_route('post.show', ['id' => $id])->with('message', 'Your comment has been posted successfully!');
    }

    private function getPostInfo(int $id): array
    {
        $data = Post::find($id);

        return [
            'id' => $data->id,
            'title' => $data->title,
            'description' => $data->description,
            'tradeAction' => $data->tradeAction,
            'createdAt' => $data->created_at,
            'author' => $data->user,
        ];
    }

    private function getComments(int $id): array
    {
        $data = Comment::where('post_id', $id)->get();

        $comments = [];
        foreach ($data as $comment) {

            $comments[] = [
                'comment' => $comment->comment,
                'author' => $comment->User->username,
                'authorId' => $comment->User->id,
                'author_avatar' => $comment->User->avatar,
            ];
        }

        return $comments;
    }

    private function getPaginatedPosts(): array
    {
        $recentPosts = Post::orderBy('created_at', 'desc')->paginate(10);

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
}
