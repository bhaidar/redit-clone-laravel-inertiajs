<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Inertia\Inertia;

class CommunityController extends Controller
{
    public function __invoke(string $slug)
    {
        $community = Community::query()->where('slug', $slug)->first();

        return Inertia::render('Frontend/Communities/Show', compact('community'));
    }
}
