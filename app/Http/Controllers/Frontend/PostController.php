<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostShowResource;
use App\Models\Community;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function show(Community $community, Post $post)
    {
        $post = $post->load(
            [
                'user:id,username',
                'comments:id,user_id,post_id,content',
                'comments.user:id,username',
                'postVotes' => function ($query) {
                    $query
                        ->where('user_id', auth()->id())
                        ->select('id', 'user_id', 'post_id', 'vote');
                },
            ]
        );
        $post = new PostShowResource($post);

        $posts = PostResource::collection($community->posts()->orderBy('votes', 'desc')->take(6)->get());

        return Inertia::render('Frontend/Posts/Show', compact('community', 'post', 'posts'));
    }

    // $posts = PostResource::collection($community->posts()->orderBy('votes', 'desc')->take(6)->get());
    // $can_update = Auth::check() ? Auth::user()->can('update', $community_post) : false;
    // $can_delete = Auth::check() ? Auth::user()->can('delete', $community_post) : false;
}
