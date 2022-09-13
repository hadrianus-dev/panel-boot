<?php

declare(strict_types=1);

namespace Domain\Church\ValueObject;

use Illuminate\Support\Str;

class ChurchValueObject
{
    public function __construct(
        public string $title,
        public null|string $body = null,
        public null|string $description = null,
        public null|bool $published = false,
        /* public int $user_id */
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
            'user_id' => 1, 
        ];
    }
}
