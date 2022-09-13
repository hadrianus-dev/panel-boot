<?php

declare(strict_types=1);

namespace Domain\Church\Aggragates;

use Domain\Church\Events\ChurchWasCreated;
use Domain\Church\ValueObject\ChurchValueObject;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class ChurchAggragate extends AggregateRoot
{
    public function createChurch(ChurchValueObject $object): self 
    {
        $this->recordThat(
            domainEvent: new ChurchWasCreated(object: $object)
        );
        return $this;
    }
}
