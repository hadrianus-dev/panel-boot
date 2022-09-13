<?php

declare(strict_types=1);

namespace Domain\Portfolio\ValueObject;

use Illuminate\Support\Str;

class PortfolioValueObject
{
    public function __construct(
        public string $title,
        public null|string $body = null,
        public null|string $description = null,
        public null|string $date_start = null,
        public null|string $date_finish = null,
        public null|bool $published = false,
        public int $service_id
    )
    {}

    public function toArray(): array
    {
        return [
            'title' => Str::ucfirst($this->title),
            'slug' => Str::slug($this->title),
            'body' => Str::ucfirst($this->body),
            'description' => Str::ucfirst($this->description),
            'date_start' => $this->date_start,
            'date_finish' => $this->date_finish,
            'published' => $this->published,
            'service_id' => (int) $this->service_id,
        ];
    }
}
