<?php

namespace Domain\Service\Actions;

use Domain\Service\Models\Service;
use Domain\Service\ValueObject\ServiceValueObject;

class CreateServiceAction
{
    public static function handle(ServiceValueObject $object): Service
    {
        return Service::create($object->toArray());
    }
}
