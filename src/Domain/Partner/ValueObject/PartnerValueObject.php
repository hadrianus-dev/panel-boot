<?php

declare(strict_types=1);

namespace Domain\Partner\ValueObject;

use Illuminate\Support\Str;

class PartnerValueObject
{
    public function __construct(
        public string $title,
        public null|bool $published = false,
        public null|string $cover = null,
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
