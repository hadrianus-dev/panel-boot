<?php

namespace App\Http\Resources\Api\V1\Category;

use App\Http\Resources\Api\V1\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->key,
            'type' => 'category',
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'body' => $this->body,
                'description' => $this->description,
                'published' => $this->published,
                'parent' => $this->parent,
            ],
            'timeline' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'deleted_at' => $this->deleted_at,
            ],
            'relationships' => [],
            'links' => [
                'self' => route('api:v1categoryshow', $this->key),
                'parent' => route('api:v1categoryindex'),
            ]
        ];
    }
}
