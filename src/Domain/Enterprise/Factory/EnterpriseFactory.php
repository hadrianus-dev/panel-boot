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
            published: $attributes['published'], 
            logo: (isset($attributes['logo'])) ? $attributes['logo'] : null,
            cover: (isset($attributes['cover'])) ? $attributes['cover'] : null,
            slogan: (isset($attributes['slogan'])) ? $attributes['slogan'] : null,
            mission: (isset($attributes['mission'])) ? $attributes['mission'] : null,
            vision: (isset($attributes['vision'])) ? $attributes['vision'] : null,
            value: (isset($attributes['value'])) ? $attributes['value'] : null,
            general_email: (isset($attributes['general_email'])) ? $attributes['general_email'] : null,
            comercial_email: (isset($attributes['comercial_email'])) ? $attributes['comercial_email'] : null,
            general_phone: (isset($attributes['general_phone'])) ? $attributes['general_phone'] : null,
            comercial_phone: (isset($attributes['comercial_phone'])) ? $attributes['comercial_phone'] : null,
        );
    }
}
