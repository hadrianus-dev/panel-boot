<?php

namespace App\Http\Resources\Api\V1\Service;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\Category\CategoryResource;

class ServiceResource extends JsonResource
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
            'type' => 'service',
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'body' => $this->body,
                'description' => $this->description,
                'published' => $this->published,
            ],
            'timeline' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'deleted_at' => $this->deleted_at,
            ],
            'relationships' => [
                'category' => new CategoryResource($this->whenLoaded('category')),
            ],
            'links' => [
                'self' => route('api:v1serviceshow', $this->key),
                'parent' => route('api:v1serviceindex'),
            ]
        ];
    }
}
