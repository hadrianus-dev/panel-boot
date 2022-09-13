<?php

namespace Domain\Portfolio\Actions;

use Domain\Portfolio\Models\Portfolio;
use Domain\Portfolio\ValueObject\PortfolioValueObject;

class CreatePortfolioAction
{
    public static function handle(PortfolioValueObject $object): Portfolio
    {
        return Portfolio::create($object->toArray());
    }
}
