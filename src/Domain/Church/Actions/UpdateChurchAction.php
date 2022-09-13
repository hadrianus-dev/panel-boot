<?php

declare(strict_types=1);

namespace Domain\Church\Actions;

use Domain\Church\Models\Church;
use Domain\Church\ValueObject\ChurchValueObject;

class UpdateChurchAction
{
    public static function handle(ChurchValueObject $object, Church $church): bool
    {
        return $church->update($object->toArray());
    }
}
