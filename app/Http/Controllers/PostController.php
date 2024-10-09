<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function __invoke():Response
    {
        return Inertia::render('Posts/Index/ForumIndex');
    }
    public function create(): Response
    {
        return Inertia::render('Posts/Create/CreatePost');
    }
}
