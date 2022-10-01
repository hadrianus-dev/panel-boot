<?php

declare(strict_types=1);

namespace Domain\Team\Actions;

use Domain\Team\Models\Team;
use Domain\Team\ValueObject\TeamValueObject;

class UpdateTeamAction
{
    public static function handle(TeamValueObject $object, Team $Team): bool
    {
        return $Team->update($object->toArray());
    }
}
