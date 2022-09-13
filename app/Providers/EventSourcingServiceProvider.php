<?php

namespace App\Providers;

use Domain\Shared\User\Projects\UserProjector;
use Domain\Shared\User\Reactors\UserReactor;
use Illuminate\Support\ServiceProvider;
use Spatie\EventSourcing\Facades\Projectionist;

class EventSourcingServiceProvider extends ServiceProvider
{
   
    public function register(): void
    {
        Projectionist::addProjectors(
            projectors: [UserProjector::class]
        );

        Projectionist::addReactors(
            reactors: [UserReactor::class]
        );
    }

   
    public function boot(): void
    {
        //
    }
}
