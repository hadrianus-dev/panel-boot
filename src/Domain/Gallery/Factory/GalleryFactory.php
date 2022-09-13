<?php

declare(strict_types=1);

namespace Domain\Gallery\Factory;

use Domain\Gallery\ValueObject\GalleryValueObject;

class GalleryFactory
{
    public static function create(array $attributes): GalleryValueObject 
    {
        return new GalleryValueObject(
            title: $attributes['title'],
            description: $attributes['description'],
            cover: $attributes['cover'], 
            post_id: $attributes['post_id'], 
            portfolio_id: $attributes['portfolio_id'], 
        );
    }
}
