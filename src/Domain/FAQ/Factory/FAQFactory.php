<?php

declare(strict_types=1);

namespace Domain\FAQ\Factory;

use Domain\FAQ\ValueObject\FAQValueObject;

class FAQFactory
{
    public static function create(array $attributes): FAQValueObject 
    {
        return new FAQValueObject(
            question: $attributes['question'],
            response: $attributes['response'],
            published: (($attributes['published'] === 1 || $attributes['published'] === true)) ? true : false, 
            service_id: (isset($attributes['service_id'])) ?(int) $attributes['service_id'] : null, 
            portfolio_id: (isset($attributes['portfolio_id'])) ?(int) $attributes['portfolio_id'] : null, 
        );
    }
}
