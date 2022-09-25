<?php

declare(strict_types=1);

namespace Domain\Portfolio\Factory;

use Domain\Portfolio\ValueObject\PortfolioValueObject;

class PortfolioFactory
{
    public static function create(array $attributes): PortfolioValueObject 
    {
        return new PortfolioValueObject(
            title: $attributes['title'],
            body: $attributes['body'],
            description: $attributes['description'],
            date_start: $attributes['date_start'],
            date_finish: $attributes['date_finish'],
            service_id: (isset($attributes['service_id'])) ? (int) $attributes['service_id'] : null, 
            published: $attributes['published'], 
        );
    }

}
