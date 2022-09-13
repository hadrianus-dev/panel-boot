<?php

declare(strict_types=1);

namespace Domain\Service\ValueObject;

use Illuminate\Support\Str;

class ServiceValueObject
{
    public function __construct(
        public string $title,
        public null|string $body = null,
        public null|string $description = null,
        public null|bool $published = false,
        public null|int $category_id = null
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
            'category_id' => $this->category_id,
        ];
    }
}
