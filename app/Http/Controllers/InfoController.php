<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class InfoController extends Controller
{
    public function AboutUs(): Response
    {
        return Inertia::render('Info/AboutUs/AboutUs');
    }

    public function Services(): Response
    {
        return Inertia::render('Info/Services/Services');
    }

    public function Terms(): Response
    {
        return Inertia::render('Info/Terms&Rules/Terms');
    }
}
