<?php

declare(strict_types=1);

namespace Domain\Shared\Models\Concerns;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::creating(
            fn (Model $model) => $model->slug = Str::slug($model->title)
        );
    }
}

