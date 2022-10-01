<?php

declare(strict_types=1);

namespace Domain\Team\ValueObject;

use Illuminate\Support\Str;

class TeamValueObject
{
    public function __construct(
        public string $full_name,
        public string $email,
        public string $phone_number,
        public null|string $responsability = null,
        public null|string $description = null,
        public null|bool $published = false,
        public null|string $cover,
    )
    {}

    public function toArray(): array
    {
        return [
            'full_name' => Str::ucfirst($this->full_name),
            'slug' => Str::slug($this->full_name),
            'email' => Str::lower($this->email),
            'phone_number' => Str::lower($this->phone_number),
            'responsability' => Str::ucfirst($this->responsability),
            'description' => $this->description,
            'published' => $this->published,
            'cover' => $this->cover,
        ];
    }
}
