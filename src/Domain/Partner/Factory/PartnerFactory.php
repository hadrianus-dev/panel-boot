<?php

declare(strict_types=1);

namespace Domain\Partner\Factory;

use Domain\Partner\ValueObject\PartnerValueObject;

class PartnerFactory
{
    public static function create(array $attributes): PartnerValueObject 
    {
        return new PartnerValueObject(
            title: $attributes['title'],
            published: (bool) $attributes['published'], 
            cover: $attributes['cover'],
        );
    }
}
