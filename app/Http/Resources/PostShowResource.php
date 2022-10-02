<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'url' => $this->url,
            'created_at' => $this->created_at->diffForHumans(),
            'username' => $this->user->username,
            'is_owner' => auth()->id() === $this->user_id,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'votes' => $this->votes,
            'postVotes' => $this->whenLoaded('postVotes'),
        ];
    }
}
