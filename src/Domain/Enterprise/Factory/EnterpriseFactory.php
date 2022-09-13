<?php

declare(strict_types=1);

namespace Domain\Enterprise\Factory;

use Domain\Enterprise\ValueObject\EnterpriseValueObject;

class EnterpriseFactory
{
    public static function create(array $attributes): EnterpriseValueObject 
    {
        return new EnterpriseValueObject(
            title: $attributes['title'],
            body: $attributes['body'],
            description: $attributes['description'],
            founder: $attributes['founder'], 
            logo: $attributes['logo']
        );
    }
}
