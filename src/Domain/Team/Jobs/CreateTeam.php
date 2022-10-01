<?php

declare(strict_types=1);

namespace Domain\Team\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Domain\Team\Actions\CreateTeamAction;
use Domain\Team\Aggragates\TeamAggragate;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Team\ValueObject\TeamValueObject;

class CreateTeam implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public TeamValueObject $object
    ){}

    public function handle(): void
    {
        CreateTeamAction::handle(object: $this->object);
    }
}
