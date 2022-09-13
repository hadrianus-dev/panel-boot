<?php

declare(strict_types=1);

namespace Domain\Portfolio\Models;

use Illuminate\Database\Eloquent\Model;
use Domain\Shared\Models\Concerns\HasSlug;
use Domain\Portfolio\Models\Builders\PortfolioBuilder;
use Domain\Service\Models\Service;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    use HasKey;
    use HasSlug;
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'slug',
        'body',
        'description',
        'published',
        'service_id'
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public function getRouteKeyName(): string
    {
        return 'key';
    }

    public function newEloquentBuilder($query): PortfolioBuilder
    {
        return new PortfolioBuilder(
            query: $query
        );
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(
            related: Service::class,
            foreignKey: 'service_id'
        );
    }
}
