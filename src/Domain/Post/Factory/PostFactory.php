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
            cover: $attributes['cover'], 
            category_id: $attributes['category_id'], 
            user_id: $attributes['user_id'], 
        );
    }
}
