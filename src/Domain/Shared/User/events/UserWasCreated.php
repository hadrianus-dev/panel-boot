<?php

declare(strict_types=1);

namespace Domain\Shared\User\events;

use Domain\Shared\User\ValueObject\UserValueObject;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class UserWasCreated extends ShouldBeStored
{
    public function __construct(public UserValueObject $object){}
}
