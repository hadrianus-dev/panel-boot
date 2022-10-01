<?php

namespace Domain\Team\Actions;

use Domain\Team\Models\Team;
use Domain\Team\ValueObject\TeamValueObject;

class CreateTeamAction
{
    public static function handle(TeamValueObject $object): Team
    {
        return Team::create($object->toArray());
    }
}
