<?php

namespace Domain\Enterprise\Actions;

use Domain\Enterprise\Models\Enterprise;
use Domain\Enterprise\ValueObject\EnterpriseValueObject;

class CreateEnterpriseAction
{
    public static function handle(EnterpriseValueObject $object): Enterprise
    {
        return Enterprise::create($object->toArray());
    }
}
