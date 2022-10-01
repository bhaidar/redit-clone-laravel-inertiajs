<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Post;

class PostCommentController extends Controller
{
    public function store(Community $community, Post $post)
    {
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => request('content'),
        ]);

        return back();
    }
}
