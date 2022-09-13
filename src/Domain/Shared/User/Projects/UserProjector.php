<?php

declare(strict_types=1);

namespace Domain\Shared\User\Projects;

use Domain\Shared\User\events\UserWasCreated;
use Domain\Shared\User\Actions\CreateUserAction;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class UserProjector extends Projector
{
    public function onUserWasCreated(UserWasCreated $event): void
    {
        CreateUserAction::handle(object: $event->object);
    }
}
