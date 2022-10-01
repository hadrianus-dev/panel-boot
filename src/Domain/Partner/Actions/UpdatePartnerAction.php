<?php

declare(strict_types=1);

namespace Domain\Partner\Actions;

use Domain\Partner\Models\Partner;
use Domain\Partner\ValueObject\PartnerValueObject;

class UpdatePartnerAction
{
    public static function handle(PartnerValueObject $object, Partner $Partner): bool
    {
        return $Partner->update($object->toArray());
    }
}
