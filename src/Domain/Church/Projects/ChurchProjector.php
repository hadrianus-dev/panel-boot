<?php

declare(strict_types=1);

namespace Domain\Church\Projects;

use Domain\Church\Actions\CreateChurchAction;
use Domain\Church\Events\ChurchWasCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class ChurchProjector extends Projector
{
    public function onChurchWasCreated(ChurchWasCreated $event): void
    {
        CreateChurchAction::handle(object: $event->object);
    }
}
