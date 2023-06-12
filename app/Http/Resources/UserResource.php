<?php

namespace App\Http\Resources;

use App\Support\TwoFactorAuthenticator;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'          => $this->name,
            'email'         => $this->email,
            'allTokens'         => $this->tokens,
        ];
    }
}
