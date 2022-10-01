<?php

declare(strict_types=1);

namespace Domain\Comment\Models;

use Domain\Portfolio\Models\Portfolio;
use Illuminate\Database\Eloquent\Model;
use Domain\Comment\Models\Builders\CommentBuilder;
use Domain\Post\Models\Post;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Comment extends Model
{
    use HasKey;
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'email',
        'body',
        'published',
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

    public function newEloquentBuilder($query): CommentBuilder
    {
        return new CommentBuilder(
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
