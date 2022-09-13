<?php

declare(strict_types=1);

namespace Domain\Church\Events;

use Domain\Church\ValueObject\ChurchValueObject;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ChurchWasCreated extends ShouldBeStored
{
    public function __construct(public ChurchValueObject $object){}
}
