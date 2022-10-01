<?php

namespace Domain\Comment\Actions;

use Domain\Comment\Models\Comment;
use Domain\Comment\ValueObject\CommentValueObject;

class CreateCommentAction
{
    public static function handle(CommentValueObject $object): Comment
    {
        return Comment::create($object->toArray());
    }
}
