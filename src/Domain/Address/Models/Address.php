<?php

declare(strict_types=1);

namespace Domain\Address\Models;

use Illuminate\Database\Eloquent\Model;
use Domain\Address\Models\Builders\AddressBuilder;
use Domain\Enterprise\Models\Enterprise;
use Domain\Shared\Models\User;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasKey;
    use HasFactory;

    protected $fillable = [
        'key',
        'state_id',
        'city_id',
        'district',
        'street',
        'home',
        'published',
        'user_id',
        'enterprise_id',
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public function getRouteKeyName(): string
    {
        return 'key';
    }

    public function newEloquentBuilder($query): AddressBuilder
    {
        return new AddressBuilder(
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

    public function enterprise(): BelongsTo
    {
        return $this->belongsTo(
            related: Enterprise::class,
            foreignKey: 'enterprise_id'
        );
    }
}
