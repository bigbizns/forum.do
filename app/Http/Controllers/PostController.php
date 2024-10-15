<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\TradeActionEnum;
use App\Http\Requests\StorePost;
use App\Models\Category;
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

    public function showPost(int $id):Response
    {
        $post = $this->getPostInfo($id);

        return Inertia::render('Posts/Show/ShowPost', ['post' => $post]);
    }

    public function create(): Response
    {
        $categories = Category::all(['id','title', 'marketplace']);
        $tradeActions = tradeActionEnum::getTradeActions();

        return Inertia::render('Posts/Create/CreatePost', ['categories' => $categories , 'tradeActions' => $tradeActions]);
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

    private function getPostInfo(int $id):array
    {
        $data = Post::find($id);

        return [
            'title' => $data->title,
            'description' => $data->description,
            'tradeAction' => $data->tradeAction,
            'createdAt' => $data->created_at,
            'author'=> $data->user,
        ];
    }
}
