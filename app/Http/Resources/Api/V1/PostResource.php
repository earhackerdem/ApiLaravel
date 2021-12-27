<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'extract' => $this->extract,
            'status' => $this->status === 1 ? 'BORRADOR' : 'PUBLICADO',
            'user' => UserResource::make($this->whenLoaded('user')),
            'category' => CategoryResource::make($this->whenLoaded('category'))
        ];
    }
}
