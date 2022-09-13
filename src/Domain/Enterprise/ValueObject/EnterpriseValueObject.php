<?php

declare(strict_types=1);

namespace Domain\Enterprise\ValueObject;

use Illuminate\Support\Str;

class EnterpriseValueObject
{
    public function __construct(
        public string $title,
        public null|string $body = null,
        public null|string $description = null,
        public string $founder,
        public null|bool $published = false,
        public string $logo,
        public null|string $cover = null,
    )
    {}

    public function toArray(): array
    {
        return [
            'title' => Str::ucfirst($this->title),
            'slug' => Str::slug($this->title),
            'body' => Str::ucfirst($this->body),
            'description' => Str::ucfirst($this->description),
            'founder' => Str::ucfirst($this->founder),
            'published' => $this->published,
            'logo' => $this->logo,
            'cover' => $this->cover,
        ];
    }
}
