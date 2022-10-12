<?php

declare(strict_types=1);

namespace Domain\Aparence\Actions;

use Domain\Aparence\Models\Aparence;
use Domain\Aparence\ValueObject\AparenceValueObject;

class UpdateAparenceAction
{
    public static function handle(AparenceValueObject $object, Aparence $Aparence): bool
    {
        return $Aparence->update($object->toArray());
    }
}
