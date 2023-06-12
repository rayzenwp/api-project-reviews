<?php

namespace App\Http\Resources;

use App\Support\TwoFactorAuthenticator;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'       		=> $this->id,
            'body'          => $this->body,
            'likeCount'     => $this->like_count,
            'thumbnail'     => $this->thumbnail,
			'user' 			=> $this->user->name,
			'theme' 	    => $this->reviewTheme->name,
            'createdAt'     => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
