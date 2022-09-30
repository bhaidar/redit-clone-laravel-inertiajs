<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommunityPostUpdateRequest;
use App\Http\Requests\StoreCommunityPostRequest;
use App\Models\Community;
use App\Models\Post;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

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
        abort_if(request()->user()->cannot('update', $post), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return Inertia::render('Communities/Posts/Edit', compact('community', 'post'));
    }

    public function update(CommunityPostUpdateRequest $request, Community $community, Post $post)
    {
        abort_if(request()->user()->cannot('update', $post), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->update($request->validated());

        return to_route('frontend.communities.posts.show', [$community, $post])->withMessage('Post updated successfully.');
    }

    public function destroy(Community $community, Post $post)
    {
        abort_if(request()->user()->cannot('delete', $post), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->delete();

        return to_route('frontend.communities.show', [$community, $post])->withMessage('Post deleted successfully.');
    }
}
