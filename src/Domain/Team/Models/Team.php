<?php

declare(strict_types=1);

namespace Domain\Team\Models;

use Illuminate\Database\Eloquent\Model;
use Domain\Shared\Models\Concerns\HasSlug;
use Domain\Team\Models\Builders\TeamBuilder;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasKey;
    use HasSlug;
    use HasFactory;

    protected $fillable = [
        'key',
        'full_name',
        'slug',
        'email',
        'phone_number',
        'responsability',
        'description',
        'published',
        'cover',
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public function getRouteKeyName(): string
    {
        return 'key';
    }

    public function newEloquentBuilder($query): TeamBuilder
    {
        return new TeamBuilder(
            query: $query
        );
    }

}
