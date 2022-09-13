<?php

declare(strict_types=1);

namespace Domain\Service\Factory;

use Domain\Service\ValueObject\ServiceValueObject;

class ServiceFactory
{
    public static function create(array $attributes): ServiceValueObject 
    {
        return new ServiceValueObject(
            title: $attributes['title'],
            body: $attributes['body'],
            description: $attributes['description'],
            published: $attributes['published'], 
            category_id: $attributes['category_id'], 
        );
    }
}
