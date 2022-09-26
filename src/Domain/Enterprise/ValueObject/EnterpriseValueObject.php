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
        public null|string $logo = null,
        public null|string $cover = null,
        public null|string $slogan = null,
        public null|string $mission = null,
        public null|string $vision = null,
        public null|string $value = null,
        public null|string $general_email = null,
        public null|string $comercial_email = null,
        public null|string $general_phone = null,
        public null|string $comercial_phone = null,
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
            'slogan'  => $this->slogan,
            'mission' => $this->mission,
            'vision'  => $this->vision,
            'value'   => $this->value,
            'general_email'  => $this->general_email,
            'comercial_email' => $this->comercial_email,
            'general_phone'  => $this->general_phone,
            'comercial_phone'=> $this->comercial_phone,
        ];
    }
}
