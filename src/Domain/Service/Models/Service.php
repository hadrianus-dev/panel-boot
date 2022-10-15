<?php

declare(strict_types=1);

namespace Domain\Service\Models;

use Domain\FAQ\Models\FAQ;
use Domain\Category\Models\Category;
use Domain\Portfolio\Models\Portfolio;
use Shetabit\Visitor\Traits\Visitable;
use Illuminate\Database\Eloquent\Model;
use Domain\Shared\Models\Concerns\HasSlug;
use Domain\Service\Models\Builders\ServiceBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasKey;
    use HasSlug;
    use HasFactory;
    use Visitable;

    protected $fillable = [
        'key',
        'title',
        'slug',
        'body',
        'description',
        'published',
        'category_id'
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public function getRouteKeyName(): string
    {
        return 'key';
    }

    public function newEloquentBuilder($query): ServiceBuilder
    {
        return new ServiceBuilder(
            query: $query
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            related: Category::class,
            foreignKey: 'category_id'
        );
    }

    public function portfolio(): HasMany
    {
        return $this->hasMany(
            related: Portfolio::class,
            foreignKey: 'service_id'
        );
    }

    public function FAQ(): HasMany
    {
        return $this->hasMany(
            related: FAQ::class,
            foreignKey: 'service_id'
        );
    }
}
