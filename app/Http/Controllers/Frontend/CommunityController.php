<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommunityPostResource;
use App\Http\Resources\CommunityResource;
use App\Models\Community;
use Inertia\Inertia;

class CommunityController extends Controller
{
    public function show(string $slug)
    {
        $community = Community::query()->where('slug', $slug)->firstOrFail();
        $posts = CommunityPostResource::collection($community->posts()->with(
            [
                'user:id,username',
                'postVotes' => function ($query) {
                    $query
                        ->where('user_id', auth()->id())
                        ->select('id', 'user_id', 'post_id', 'vote');
                },
            ]
        )->withCount('comments')->paginate(2));

        $communities = CommunityResource::collection(Community::withCount('posts')->orderBy('created_at', 'desc')->take(6)->get());

        return Inertia::render('Frontend/Communities/Show', compact('community', 'posts', 'communities'));
    }
}
