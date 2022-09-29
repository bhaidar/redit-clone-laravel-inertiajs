<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommunityPostUpdateRequest;
use App\Http\Requests\StoreCommunityPostRequest;
use App\Models\Community;
use App\Models\Post;
use Inertia\Inertia;

class CommunityPostController extends Controller
{
    public function create(Community $community)
    {
        return Inertia::render('Communities/Posts/Create', compact('community'));
    }

    public function store(StoreCommunityPostRequest $request, Community $community)
    {
        $community->posts()->create($request->validated() + ['user_id' => auth()->id()]);

        return to_route('frontend.communities.show', $community->slug)->withMessage('Post created successfully');
    }

    public function edit(Community $community, Post $post)
    {
        return Inertia::render('Communities/Posts/Edit', compact('community', 'post'));
    }

    public function update(CommunityPostUpdateRequest $request, Community $community, Post $post)
    {
        $post->update($request->validated());

        return to_route('frontend.communities.posts.show', [$community, $post])->withMessage('Post updated successfully.');
    }

    public function destroy(Community $community, Post $post)
    {
        $post->delete();

        return to_route('frontend.communities.show', [$community, $post])->withMessage('Post deleted successfully.');
    }
}
