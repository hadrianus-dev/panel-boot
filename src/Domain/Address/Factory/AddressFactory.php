<?php

declare(strict_types=1);

namespace Domain\Address\Factory;

use Domain\Address\ValueObject\AddressValueObject;

class AddressFactory
{
    public static function create(array $attributes): AddressValueObject 
    {
        return new AddressValueObject(
            state_id: $attributes['state_id'],
            city_id: $attributes['city_id'],
            district: $attributes['district'],
            street: $attributes['street'], 
            home: $attributes['home'],
            published: $attributes['published'],
            user_id: $attributes['user_id'],
            enterprise_id: $attributes['enterprise_id'],
        );
    }
}
