<?php

namespace Domain\Shared\User\Actions;

use Domain\Shared\Models\User;
use Domain\Shared\User\ValueObject\UserValueObject;


class CreateUserAction
{
    public static function handle(UserValueObject $object): User
    {
        return User::create($object->toArray());
    }
}
