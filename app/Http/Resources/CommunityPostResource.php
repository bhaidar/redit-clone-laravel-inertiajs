<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommunityPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'url' => $this->url,
            'created_at' => $this->created_at->diffForHumans(),
            'username' => $this->user->username,
            'votes' => $this->votes,
            'postVotes' => $this->whenLoaded('postVotes'),
            'community_slug' => $this->community->slug,
            'comments_count' => $this->comments_count,
        ];
    }
}
