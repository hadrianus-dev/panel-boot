<?php

namespace Domain\Address\Actions;

use Domain\Address\Models\Address;
use Domain\Address\ValueObject\AddressValueObject;

class CreateAddressAction
{
    public static function handle(AddressValueObject $object): Address
    {
        return Address::create($object->toArray());
    }
}
