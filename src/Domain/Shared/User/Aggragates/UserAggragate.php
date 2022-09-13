<?php

declare(strict_types=1);

namespace Domain\Shared\User\Aggragates;

use Domain\Shared\User\events\UserWasCreated;
use Domain\Shared\User\ValueObject\UserValueObject;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class UserAggragate extends AggregateRoot
{
    public function createUser(UserValueObject $object): self 
    {
        $this->recordThat(
            domainEvent: new UserWasCreated(object: $object)
        );
        return $this;
    }
}
