<?php

declare(strict_types=1);

namespace Domain\Service\Models;

use Domain\Category\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Domain\Shared\Models\Concerns\HasSlug;
use Domain\Service\Models\Builders\ServiceBuilder;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
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
}
