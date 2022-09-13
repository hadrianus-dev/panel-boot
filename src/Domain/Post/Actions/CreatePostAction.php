<?php

namespace Domain\Post\Actions;

use Domain\Post\Models\Post;
use Domain\Post\ValueObject\PostValueObject;

class CreatePostAction
{
    public static function handle(PostValueObject $object): Post
    {
        return Post::create($object->toArray());
    }
}
