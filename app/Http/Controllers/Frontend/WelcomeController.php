<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommunityPostResource;
use App\Models\Post;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index()
    {
        $posts = CommunityPostResource::collection(Post::with(
            [
                'user:id,username',
                'community:id,slug',
                'postVotes' => function ($query) {
                    $query
                        ->where('user_id', auth()->id())
                        ->select('id', 'user_id', 'post_id', 'vote');
                },
            ]
        )->orderBy('votes', 'desc')->take(12)->get());

        return Inertia::render('Frontend/Welcome', compact('posts'));
    }
}
