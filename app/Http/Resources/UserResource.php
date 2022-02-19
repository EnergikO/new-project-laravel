<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    //     return [
    //         'id' => $this->id,
    //         'user_name' => $this->user_name,
    //         '_token' => $this->_token,
    //         'posts' => PostResource::collection($this->posts),
    //     ];
    }
}
