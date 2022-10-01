<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostShowResource;
use App\Models\Community;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function show(Community $community, Post $post)
    {
        $post = $post->load('user:id,username', 'comments:id,user_id,post_id,content', 'comments.user:id,username');
        $post = new PostShowResource($post);

        return Inertia::render('Frontend/Posts/Show', compact('community', 'post'));
    }
}
