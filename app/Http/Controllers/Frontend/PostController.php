<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Post;

class PostController extends Controller
{
    public function show(Community $community, Post $post)
    {
        dd($community, $post);
    }
}
