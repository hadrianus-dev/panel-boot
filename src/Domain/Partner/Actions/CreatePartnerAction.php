<?php

namespace Domain\Partner\Actions;

use Domain\Partner\Models\Partner;
use Domain\Partner\ValueObject\PartnerValueObject;

class CreatePartnerAction
{
    public static function handle(PartnerValueObject $object): Partner
    {
        return Partner::create($object->toArray());
    }
}
