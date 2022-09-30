<?php

declare(strict_types=1);

namespace Domain\Enterprise\Models;

use Domain\Category\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Domain\Shared\Models\Concerns\HasSlug;
use Domain\Enterprise\Models\Builders\EnterpriseBuilder;
use Domain\Shared\Models\User;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enterprise extends Model
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
        'slogan',
        'mission',
        'vision',
        'value',
        'general_email',
        'comercial_email',
        'general_phone',
        'comercial_phone',
        'founder',
        'published',
        'logo',
        'cover',
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public function getRouteKeyName(): string
    {
        return 'key';
    }

    public function newEloquentBuilder($query): EnterpriseBuilder
    {
        return new EnterpriseBuilder(
            query: $query
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id'
        );
    }
}
