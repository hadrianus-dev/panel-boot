<?php

declare(strict_types=1);

namespace Domain\Aparence\ValueObject;

use Illuminate\Support\Str;

class AparenceValueObject
{
    public function __construct(
        public string $title,
        public null|bool $published = false,
        public null|string $cover,
    )
    {}

    public function toArray(): array
    {
        return [
            'title' => Str::ucfirst($this->title),
            'slug' => Str::slug($this->title),
            'published' => $this->published,
            'cover' => $this->cover,
        ];
    }
}
