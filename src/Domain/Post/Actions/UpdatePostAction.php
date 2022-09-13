<?php

declare(strict_types=1);

namespace Domain\Post\Actions;

use Domain\Post\Models\Post;
use Domain\Post\ValueObject\PostValueObject;

class UpdatePostAction
{
    public static function handle(PostValueObject $object, Post $Post): bool
    {
        return $Post->update($object->toArray());
    }
}
