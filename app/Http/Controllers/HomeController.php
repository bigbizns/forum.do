<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\LengthEnum;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(string $slug = ''): Response
    {
        $user = $this->getUserInfo();
        $recentPosts = $this->getPaginatedPosts();
        $categories = Category::all(['id', 'title', 'slug']);
        $subCategories = $this->getSelectedCategorySubCategories($slug);

        return Inertia::render('Home/Home',
            [
                'userData' => $user,
                'recentPosts' => $recentPosts,
                'categories' => $categories,
                'subCategories' => $subCategories,
            ]
        );
    }

    public function searchBar(Request $request)
    {
        $text = $request['search'];

        if (empty($text)) {
            return [];
        }
        $data = Post::where('title', 'like', '%' . $text . '%')->take(3)->get();

        $posts = [];

        foreach ($data as $post) {
            $user = User::where('id', $post->user_id)->first();

            $posts[] = [
                'user_id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'id' => $post->id,
                'title' => $post->title,
                'description' => $post->description,
                'tradeAction' => $post->tradeAction,
                'pinned' => $post->pinned,
            ];
        }

        return $posts;
    }

    private function getSelectedCategorySubCategories(string $slug): array
    {
        if (!empty($slug)) {
            $category = Category::where('slug', $slug)->first();

            return SubCategory::where('category_id', $category->id)->get()->toArray();
        }

        return SubCategory::all()->toArray();
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
        $recentPosts = Post::orderBy('created_at', 'desc')->take(LengthEnum::Fifty->value)->get();

        $currentPage = request()->get('page', 1);
        $perPage = 10;
        $total = $recentPosts->count();
        $lastPage = ceil($total / $perPage);

        if ($currentPage > $lastPage) {
            $currentPage = 1;
        }

        $posts = $recentPosts->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $pageNumbers = [];
        for ($page = 1; $page <= $lastPage; $page++) {
            $pageNumbers[] = [
                'page' => $page,
                'currentPage' => $currentPage,
                'lastPage' => $lastPage,
            ];
        }

        return [
            'data' => $posts,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $lastPage,
                'per_page' => $perPage,
                'total' => $total,
                'next_page_url' => ($currentPage < $lastPage) ? url()->current() . '?page=' . ($currentPage + 1) : null,
                'prev_page_url' => ($currentPage > 1) ? url()->current() . '?page=' . ($currentPage - 1) : null,
            ],
            'pageNumbers' => $pageNumbers,
        ];
    }
}
