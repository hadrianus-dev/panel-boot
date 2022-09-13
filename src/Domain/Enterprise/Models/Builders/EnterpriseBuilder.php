<?php

declare(strict_types=1);

namespace Domain\Enterprise\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class EnterpriseBuilder extends Builder
{
    public function published(): self
    {
        return $this->where(column: 'published', operator: true);
    }

    public function draft(): self
    {
        return $this->where(column: 'published', operator: false);
    }
}
    
