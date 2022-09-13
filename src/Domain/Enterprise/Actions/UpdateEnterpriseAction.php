<?php

declare(strict_types=1);

namespace Domain\Enterprise\Actions;

use Domain\Enterprise\Models\Enterprise;
use Domain\Enterprise\ValueObject\EnterpriseValueObject;

class UpdateEnterpriseAction
{
    public static function handle(EnterpriseValueObject $object, Enterprise $Enterprise): bool
    {
        return $Enterprise->update($object->toArray());
    }
}
