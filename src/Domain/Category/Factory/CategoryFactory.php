<?php

declare(strict_types=1);

namespace Domain\Category\Factory;

use Domain\Category\ValueObject\CategoryValueObject;

class CategoryFactory
{
    public static function create(array $attributes): CategoryValueObject 
    {
        return new CategoryValueObject(
            title: $attributes['title'],
            body: $attributes['body'],
            description: ($attributes['description']) ? $attributes['description'] : null,
            parent: ($attributes['parent']) ? (int) $attributes['parent'] : null, 
            published: (isset($attributes['published'])) ? (bool) true : false
        );
    }
}
