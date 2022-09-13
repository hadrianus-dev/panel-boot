<?php

declare(strict_types=1);

namespace Domain\Shared\User\Factory;

use Domain\Shared\User\ValueObject\UserValueObject;

class UserFactory
{
    public static function create(array $attributes): UserValueObject 
    {
        return new UserValueObject(
            first_name: $attributes['first_name'],
            last_name: $attributes['last_name'],
            email: $attributes['email'],
            password: $attributes['password']
        );
    }
}
