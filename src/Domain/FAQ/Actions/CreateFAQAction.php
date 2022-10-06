<?php

namespace Domain\FAQ\Actions;

use Domain\FAQ\Models\FAQ;
use Domain\FAQ\ValueObject\FAQValueObject;

class CreateFAQAction
{
    public static function handle(FAQValueObject $object): FAQ
    {
        return FAQ::create($object->toArray());
    }
}
