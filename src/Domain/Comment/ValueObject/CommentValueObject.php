<?php

declare(strict_types=1);

namespace Domain\Comment\ValueObject;

use Illuminate\Support\Str;

class CommentValueObject
{
    public function __construct(
        public string $name,
        public null|string $email,
        public null|string $body,
        public null|bool $published = false,
        public null|int $post_id = null,
        public null|int $portfolio_id = null
    )
    {}

    public function toArray(): array
    {
        return [
            'name' => Str::ucfirst($this->name),
            'email' => Str::lower($this->email),
            'body' => Str::ucfirst($this->body),
            'published' => $this->published,
            'post_id' => $this->post_id,
            'portfolio_id' => $this->portfolio_id,
        ];
    }
}
