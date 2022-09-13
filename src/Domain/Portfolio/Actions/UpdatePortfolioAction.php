<?php

declare(strict_types=1);

namespace Domain\Portfolio\Actions;

use Domain\Portfolio\Models\Portfolio;
use Domain\Portfolio\ValueObject\PortfolioValueObject;

class UpdatePortfolioAction
{
    public static function handle(PortfolioValueObject $object, Portfolio $Portfolio): bool
    {
        return $Portfolio->update($object->toArray());
    }
}
