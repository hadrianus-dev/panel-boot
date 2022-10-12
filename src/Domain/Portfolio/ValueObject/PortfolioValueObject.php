<?php

declare(strict_types=1);

namespace Domain\Portfolio\ValueObject;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PortfolioValueObject
{
    public function __construct(
        public string $title,
        public null|string $body = null,
        public null|string $description = null,
        public null|string $date_start = null,
        public null|string $date_finish = null,
        public null|string $local = null,
        public null|string $client = null,
        public null|string $external_link = null,
        public null|string $cover = null,
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
            'date_start' => Carbon::parse($this->date_start)->format('Y-m-d'),
            'date_finish' => Carbon::parse($this->date_finish)->format('Y-m-d'),
            'local' => $this->local,
            'client' => $this->client,
            'external_link' => $this->external_link,
            'cover' => $this->cover,
            'published' => $this->published,
            'service_id' => (int) $this->service_id,
        ];
    }
}
