<?php

declare(strict_types=1);

namespace Domain\Shared\User\Reactors;

use App\Mail\User\NewUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Domain\Shared\User\events\UserWasCreated;
use Spatie\EventSourcing\EventHandlers\Reactors\Reactor;

class UserReactor extends Reactor implements ShouldQueue
{
    public function onUserWasCreated(UserWasCreated $event): void
    {
        $author = 'David Hadrianus';
        Mail::to('jobs.hadrianus@gmail.com')->send( mailable: new NewUser(
            object: $event->object,
        ));
    }
}
