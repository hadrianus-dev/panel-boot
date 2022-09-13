<?php

declare(strict_types=1);

namespace Domain\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Domain\Shared\Models\Concerns\HasSlug;
use Domain\Category\Models\Builders\CategoryBuilder;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
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
        'parent',
        'user_id',
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public function getRouteKeyName(): string
    {
        return 'key';
    }

    public function newEloquentBuilder($query): CategoryBuilder
    {
        return new CategoryBuilder(
            query: $query
        );
    }

    public function services(): HasMany
    {
        return $this->hasMany(
            related: Category::class,
            foreignKey: 'category_id'
        );
    }
}
