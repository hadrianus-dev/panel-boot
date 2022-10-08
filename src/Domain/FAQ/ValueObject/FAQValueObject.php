<?php

declare(strict_types=1);

namespace Domain\FAQ\ValueObject;

use Illuminate\Support\Str;

class FAQValueObject
{
    public function __construct(
        public string $question,
        public string $response,
        public null|bool $published = false,
        public null|int $service_id = null,
        public null|int $portfolio_id = null
    )
    {}

    public function toArray(): array
    {
        return [
            'question' => Str::ucfirst($this->question),
            'response' => $this->response,
            'published' => $this->published,
            'service_id' => $this->service_id,
            'portfolio_id' => $this->portfolio_id,
        ];
    }
}
