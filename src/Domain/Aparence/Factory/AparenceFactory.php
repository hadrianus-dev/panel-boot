<?php

declare(strict_types=1);

namespace Domain\Aparence\Factory;

use Domain\Aparence\ValueObject\AparenceValueObject;

class AparenceFactory
{
    public static function create(array $attributes): AparenceValueObject 
    {
        return new AparenceValueObject(
            title: $attributes['title'],
            published: (bool) $attributes['published'], 
            cover: $attributes['cover'],
        );
    }
}
