<?php

namespace Domain\Church\Actions;

use Domain\Church\Models\Church;
use Domain\Church\ValueObject\ChurchValueObject;

class CreateChurchAction
{
    public static function handle(ChurchValueObject $object): Church
    {
        return Church::create($object->toArray());
    }
}
