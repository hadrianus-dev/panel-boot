<?php

namespace Domain\Team\Jobs;

use Domain\Team\Actions\UpdateTeamAction;
use Domain\Team\Models\Team;
use Domain\Team\ValueObject\TeamValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateTeam implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Team $Team,
        public TeamValueObject $object
    ){}

    public function handle(): void
    {
        UpdateTeamAction::handle(object: $this->object, Team: $this->Team);
    }
}
