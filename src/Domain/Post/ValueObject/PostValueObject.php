<?php

declare(strict_types=1);

namespace Domain\Post\ValueObject;

use Illuminate\Support\Str;

class PostValueObject
{
    public function __construct(
        public string $title,
        public null|string $body = null,
        public null|string $description = null,
        public null|bool $published = false,
        public null|string $cover,
        public int $category_id,
        public int $user_id
    )
    {}

    public function toArray(): array
    {
        return [
            'title' => Str::ucfirst($this->title),
            'slug' => Str::slug($this->title),
            'body' => Str::ucfirst($this->body),
            'description' => Str::ucfirst($this->description),
            'published' => $this->published,
            'cover' => $this->cover,
            'category_id' => $this->category_id,
            'user_id' => $this->user_id,
        ];
    }
}
