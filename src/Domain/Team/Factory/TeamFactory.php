<?php

declare(strict_types=1);

namespace Domain\Team\Factory;

use Domain\Team\ValueObject\TeamValueObject;

class TeamFactory
{
    public static function create(array $attributes): TeamValueObject 
    {
        return new TeamValueObject(
            full_name: $attributes['full_name'],
            email: $attributes['email'],
            phone_number: $attributes['phone_number'],
            responsability: $attributes['responsability'],
            description: (isset($attributes['description'])) ? $attributes['description'] : null,
            published: (bool) $attributes['published'], 
            cover: $attributes['cover'],
        );
    }
}
