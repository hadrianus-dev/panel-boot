<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Domain\Shared\Models\Builders\ProfileBuilder;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasKey;
    use HasFactory;
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'key',
        'normal',
        'member',
        'leader',
        'manager',
        'cummercial',
        'user_id',
        'published',
    ];

    
    public function getRouteKeyName(): string
    {
        return 'key';
    }

    public function newEloquentBuilder($query): ProfileBuilder
    {
        return new ProfileBuilder(
            query: $query
        );
    }
}
