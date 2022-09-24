<?php

declare(strict_types=1);

namespace Domain\Post\Factory;

use Domain\Post\ValueObject\PostValueObject;

class PostFactory
{
    public static function create(array $attributes): PostValueObject 
    {
        return new PostValueObject(
            title: $attributes['title'],
            body: $attributes['body'],
            description: $attributes['description'],
            published: (bool) $attributes['published'], 
            cover: $attributes['cover'],
            category_id: (int) $attributes['category_id'], 
            user_id: (int) $attributes['user_id'], 
        );
    }
}
