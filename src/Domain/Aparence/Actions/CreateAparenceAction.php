<?php

namespace Domain\Aparence\Actions;

use Domain\Aparence\Models\Aparence;
use Domain\Aparence\ValueObject\AparenceValueObject;

class CreateAparenceAction
{
    public static function handle(AparenceValueObject $object): Aparence
    {
        return Aparence::create($object->toArray());
    }
}
