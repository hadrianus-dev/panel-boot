<?php

declare(strict_types=1);

namespace Domain\Gallery\Models;

use Illuminate\Database\Eloquent\Model;
use Domain\Shared\Models\Concerns\HasSlug;
use Domain\Gallery\Models\Builders\GalleryBuilder;
use Domain\Portfolio\Models\Portfolio;
use Domain\Post\Models\Post;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasKey;
    use HasSlug;
    use HasFactory;

    protected $fillable = [
        'key',
        'published',
        'cover',
        'status',
        'post_id',
        'portfolio_id'
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public function getRouteKeyName(): string
    {
        return 'key';
    }

    public function newEloquentBuilder($query): GalleryBuilder
    {
        return new GalleryBuilder(
            query: $query
        );
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(
            related: Post::class,
            foreignKey: 'post_id'
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
