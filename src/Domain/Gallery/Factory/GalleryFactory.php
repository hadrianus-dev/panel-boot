<?php

declare(strict_types=1);

namespace Domain\Gallery\Factory;

use Domain\Gallery\ValueObject\GalleryValueObject;

class GalleryFactory
{
    public static function create(array $attributes): GalleryValueObject 
    {
        return new GalleryValueObject(
            published: $attributes['published'],
            cover: $attributes['cover'], 
            status: (isset($attributes['status'])) ? $attributes['status'] : null, 
            post_id: (isset($attributes['post_id'])) ? $attributes['post_id'] : null, 
            portfolio_id: (isset($attributes['portfolio_id'])) ? $attributes['portfolio_id'] : null, 
        );
    }
}
