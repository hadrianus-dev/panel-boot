<?php

declare(strict_types=1);

namespace Domain\Comment\Actions;

use Domain\Comment\Models\Comment;
use Domain\Comment\ValueObject\CommentValueObject;

class UpdateCommentAction
{
    public static function handle(CommentValueObject $object, Comment $Comment): bool
    {
        return $Comment->update($object->toArray());
    }
}
