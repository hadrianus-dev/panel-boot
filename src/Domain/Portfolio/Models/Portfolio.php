<?php

declare(strict_types=1);

namespace Domain\Portfolio\Models;

use Domain\Gallery\Models\Gallery;
use Illuminate\Database\Eloquent\Model;
use Domain\Shared\Models\Concerns\HasSlug;
use Domain\Portfolio\Models\Builders\PortfolioBuilder;
use Domain\Service\Models\Service;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

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
        'date_start',
        'date_finish',
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

    public function before($published = false)
    {
        $data = $this->hasMany('Domain\Gallery\Models\Gallery');
        if($published) $data->where('published', false)->get();

        return $data;
    }

    public function after($published = true)
    {
        $data = $this->hasMany('Domain\Gallery\Models\Gallery');
        if($published) $data->where('published', $published);

        return $data;
    }

    public function gallery(): HasMany
    {
        return $this->hasMany(
            related: Gallery::class,
            foreignKey: 'portfolio_id'
        );
    }
}
