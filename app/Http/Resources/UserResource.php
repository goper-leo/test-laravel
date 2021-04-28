<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'email' => $this->email,
            'name' => $this->name,
            'user_name' => $this->user_name,
            'avatar_url' => $this->avatar_url,
        ];
    }
}
