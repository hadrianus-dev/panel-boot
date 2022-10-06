<?php

declare(strict_types=1);

namespace Domain\FAQ\Models;

use Domain\Portfolio\Models\Portfolio;
use Illuminate\Database\Eloquent\Model;
use Domain\FAQ\Models\Builders\FAQBuilder;
use Domain\Service\Models\Service;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FAQ extends Model
{
    use HasKey;
    use HasFactory;

    protected $fillable = [
        'key',
        'question',
        'response',
        'published',
        'service_id',
        'portfolio_id'
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public function getRouteKeyName(): string
    {
        return 'key';
    }

    public function newEloquentBuilder($query): FAQBuilder
    {
        return new FAQBuilder(
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

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(
            related: Portfolio::class,
            foreignKey: 'portfolio_id'
        );
    }
}
