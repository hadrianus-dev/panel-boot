<?php

declare(strict_types=1);

namespace Domain\Service\Actions;

use Domain\Service\Models\Service;
use Domain\Service\ValueObject\ServiceValueObject;

class UpdateServiceAction
{
    public static function handle(ServiceValueObject $object, Service $Service): bool
    {
        return $Service->update($object->toArray());
    }
}
