<?php

declare(strict_types=1);

namespace Domain\Gallery\ValueObject;

use DomainException;
use Illuminate\Support\Str;
use JustSteveKing\StatusCode\Http;

class GalleryValueObject
{
    public function __construct(
        public null|bool $published = false,
        public null|string $cover,
        public null|int $post_id = null,
        public null|int $portfolio_id = null
    )
    {
        if($this->post_id === null && $this->portfolio_id === null):
            return new DomainException('Precisa atrelar esta galeria a uma Postagem ou Portfolio.', Http::NOT_ACCEPTABLE());
        endif;
    }

    public function toArray(): array
    {
        return [
            'published' => $this->published,
            'cover' => $this->cover,
            'post_id' => ($this->post_id != null) ? $this->post_id : null,
            'portfolio_id' => ($this->portfolio_id != null) ? $this->portfolio_id : null,
        ];
    }
}
