<?php

declare(strict_types=1);

namespace Domain\Comment\Factory;

use Domain\Comment\ValueObject\CommentValueObject;

class CommentFactory
{
    public static function create(array $attributes): CommentValueObject 
    {
        return new CommentValueObject(
            name: $attributes['name'],
            email: $attributes['email'],
            body: $attributes['body'],
            published: (($attributes['published'] === 1 || $attributes['published'] === true)) ? true : false, 
            post_id: (isset($attributes['post_id'])) ? (int) $attributes['post_id'] : null, 
            portfolio_id: (isset($attributes['portfolio_id'])) ? (int) $attributes['portfolio_id'] : null, 
        );
    }
}
