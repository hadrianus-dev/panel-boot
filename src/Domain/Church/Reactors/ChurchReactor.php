<?php

declare(strict_types=1);

namespace Domain\Church\Reactors;

use App\Mail\Church\NewChurch;
use Domain\Church\Events\ChurchWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Spatie\EventSourcing\EventHandlers\Reactors\Reactor;

class ChurchReactor extends Reactor implements ShouldQueue
{
    public function onChurchWasCreated(ChurchWasCreated $event): void
    {
        $author = 'David Hadrianus';
        Mail::to('pphelder@gmail.com')->send( mailable: new NewChurch(
            object: $event->object,
        ));
    }
}
