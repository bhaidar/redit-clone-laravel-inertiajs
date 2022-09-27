<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Inertia\Inertia;

class SubredditController extends Controller
{
    public function __invoke(string $slug)
    {
        $subreddit = Community::query()->where('slug', $slug)->first();

        return Inertia::render('Subreddits/Show', compact('subreddit'));
    }
}
