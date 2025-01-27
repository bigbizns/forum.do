<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\LengthEnum;
use App\Http\Requests\StoreContactUs;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Enums\SupportTopicEnum;

class ContactUsController extends Controller
{

    public function __invoke(): Response
    {
        $topics = SupportTopicEnum::getSupportTopic();

        return Inertia::render('ContactUs/ContactUs', ['topics' => $topics]);
    }

    public function store(StoreContactUs $request): RedirectResponse
    {
        $data = $request->validated();
        $user = Auth::user();
        $userMessages = Contact::where('user_id', $user->id)->get();

        if ($userMessages->count() > LengthEnum::Ten->value) {
            return to_route('contactus')->withErrors(['message' => 'Message limit has been reached.']);
        }

        Contact::create([
            'topic' => $data['topic'],
            'email' => $user['email'],
            'user_id' => $user['id'],
            'message' => $data['message'],
        ]);

        return to_route('contactus')->with('message', 'Your message has been sent.');
    }
}
