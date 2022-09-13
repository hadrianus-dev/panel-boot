<?php

declare(strict_types=1);

namespace Domain\Shared\User\Actions;

use Domain\Shared\Models\User;
use Domain\Shared\User\ValueObject\UserValueObject;


class UpdateUserAction
{
    public static function handle(UserValueObject $object, User $user): bool
    {
        return $user->update($object->toArray());
    }
}
