<?php

declare(strict_types=1);

namespace Domain\Address\Actions;

use Domain\Address\Models\Address;
use Domain\Address\ValueObject\AddressValueObject;

class UpdateAddressAction
{
    public static function handle(AddressValueObject $object, Address $Address): bool
    {
        return $Address->update($object->toArray());
    }
}
