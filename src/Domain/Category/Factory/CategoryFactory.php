<?php

declare(strict_types=1);

namespace Domain\Category\Factory;

use Domain\Category\ValueObject\CategoryValueObject;

class CategoryFactory
{
    public static function create(array $attributes): CategoryValueObject 
    {
        #dd($attributes);
        return new CategoryValueObject(
            title: $attributes['title'],
            body: $attributes['body'],
            description: $attributes['description'],
            parent: $attributes['parent'], 
            published: $attributes['published'], 
        );
    }
}
