<?php

declare(strict_types=1);

namespace Domain\Church\Factory;

use Domain\Church\ValueObject\ChurchValueObject;

class ChurchFactory
{
    public static function create(array $attributes): ChurchValueObject 
    {
        return new ChurchValueObject(
            title: $attributes['title'],
            body: $attributes['body'],
            description: $attributes['description'],
        );
    }
}
