<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommunityPostRequest;
use App\Models\Community;
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
}
