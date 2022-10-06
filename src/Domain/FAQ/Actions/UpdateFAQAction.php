<?php

declare(strict_types=1);

namespace Domain\FAQ\Actions;

use Domain\FAQ\Models\FAQ;
use Domain\FAQ\ValueObject\FAQValueObject;

class UpdateFAQAction
{
    public static function handle(FAQValueObject $object, FAQ $FAQ): bool
    {
        return $FAQ->update($object->toArray());
    }
}
